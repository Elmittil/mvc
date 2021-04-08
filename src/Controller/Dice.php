<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\renderView;

/**
 * Controller for the index route.
 */
class Dice extends ControllerBase
{
    public function __invoke(): ResponseInterface
    {
        $data = [
            "header" => "Dice",
            "message" => "Hello, this is the index page, rendered as a layout.",
        ];

        $body = renderView("layout/dice.php", $data);
        return $this->response($body);
    }
}
