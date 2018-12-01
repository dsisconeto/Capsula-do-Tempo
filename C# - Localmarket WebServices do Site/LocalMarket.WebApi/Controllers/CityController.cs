using System;
using System.Linq;
using System.Threading.Tasks;
using Geocoding.Google;
using LocalMarket.WebApi.Entities.Geo;
using LocalMarket.WebApi.Repositories;
using Microsoft.AspNetCore.Mvc;

namespace LocalMarket.WebApi.Controllers
{
    [Route("cities")]
    [ApiController]
    public class CityController : ControllerBase
    {
        private readonly CityRepository _cityRepository;

        public CityController(CityRepository cityRepository)
        {
            _cityRepository = cityRepository;
        }

        [HttpGet, Route("latitude/{latitude}/longitude/{longitude}")]
        public async Task<ActionResult<City>> Get([FromRoute]double latitude, [FromRoute] double longitude)
        {
            if (!ModelState.IsValid) return BadRequest(ModelState);

            var apiKey = Environment.GetEnvironmentVariable("GOOGLE_API_KEY");
            var geocoder = new GoogleGeocoder { ApiKey = apiKey };
            var addresses = await geocoder.ReverseGeocodeAsync(latitude, longitude);
            var cityAddressComponent = addresses.Where(a => !a.IsPartialMatch).Select(a => a[GoogleAddressType.AdministrativeAreaLevel2]).First();
            var stateAddressComponent = addresses.Where(a => !a.IsPartialMatch).Select(a => a[GoogleAddressType.AdministrativeAreaLevel1]).First();
            var cityName = cityAddressComponent.LongName + " - " + stateAddressComponent.ShortName;

            var city = _cityRepository.FindByEqualName(cityName);
            if (city != null)
            {
                return city;
            }
            return NotFound();
        }

    }
}