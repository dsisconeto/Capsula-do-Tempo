using System;

namespace LocalMarket.WebApi.Common.Exceptions
{
    public class EntityNotFoundException : Exception
    {
        public EntityNotFoundException(string message) : base(message)
        {
        }

        public static void When(bool when, string message = "entidade não encontrada")
        {
            if (!when) return;
            throw new DomainException(message);
        }
    }
}