﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;

namespace LocalMarket.WebApi.Controllers
{
    public class HomeController : ControllerBase
    {

        public ActionResult<string> Index()
        {
            return "Localmarket";
        }
    }
}