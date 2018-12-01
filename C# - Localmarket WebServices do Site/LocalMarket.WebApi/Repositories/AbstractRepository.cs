
namespace LocalMarket.WebApi.Repositories
{
    public class AbstractRepository<T>
    {
        protected readonly DatabaseContext _context;
        protected AbstractRepository(DatabaseContext context)
        {
            _context = context;
        }
    }
}
