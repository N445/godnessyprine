<?php

namespace App\Twig;

use NumberFormatter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('displayPrice', [$this, 'displayPrice']),
        ];
    }

//    public function getFunctions(): array
//    {
//        return [
//            new TwigFunction('function_name', [$this, 'doSomething']),
//        ];
//    }

    /**
     * @param int $price
     * @return string
     */
    public function displayPrice(int $price): string
    {
        $price = $price / 100;
        $fmt   = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
        return $fmt->formatCurrency($price, "EUR");
    }
}
