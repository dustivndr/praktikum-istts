using System;
using System.Collections.Generic;
using System.Text;

namespace TempaTambang
{
    public class Artifact
    {
        public string Size { get; set; }
        public string Quality { get; set; }

        // Read-only property that calculates the price dynamically
        public int Price
        {
            get { return CalculatePrice(); }
        }

        public Artifact(string size, string quality)
        {
            Size = size;
            Quality = quality;
        }

        private int CalculatePrice()
        {
            int basePrice = 0;
            int qualityMultiplier = 1;

            // Determine base price from size
            switch (Size.ToLower())
            {
                case "small": basePrice = 500; break;
                case "medium": basePrice = 1000; break;
                case "large": basePrice = 2000; break;
                case "massive": basePrice = 4000; break;
                default: basePrice = 0; break; // Fallback
            }

            // Determine multiplier from quality
            switch (Quality.ToLower())
            {
                case "cheap": qualityMultiplier = 1; break;
                case "fair": qualityMultiplier = 2; break;
                case "expensive": qualityMultiplier = 5; break;
                default: qualityMultiplier = 1; break; // Fallback
            }

            return basePrice * qualityMultiplier;
        }

        public override string ToString()
        {
            return $"A {Size} {Quality} Artifact - ${Price}";
        }
    }
}
