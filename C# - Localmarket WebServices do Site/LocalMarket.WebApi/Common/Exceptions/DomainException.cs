using System;

namespace LocalMarket.WebApi.Common.Exceptions
{
    public class DomainException : Exception
    {
        public DomainException(string message) : base(message)
        {
        }

        public static void When(bool when, string message)
        {
            if (!when) return;
            throw new DomainException(message);
        }
    }
}