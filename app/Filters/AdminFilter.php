<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = service('auth')->getCurrentUser();
        
        if ( ! $user->is_admin) {
            
            $response = service('response');
            
            $response->setStatusCode(403);
            $response->setBody('You do not have permission to access that resource'.header('Refresh:5; url='. base_url('')));
            
            return $response;
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}