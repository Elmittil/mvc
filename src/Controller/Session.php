<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;


/**
 * Controller for the session routes.
 */
class Session
{
    use ControllerTrait;

    public function index(): ResponseInterface
    {
        $body = renderView("layout/session.php");
        return $this->response($body);
    }



    public function destroy(): ResponseInterface
    {
        destroySession();
        return $this->redirect(url("/session"));
    }
}
