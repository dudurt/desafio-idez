<?php

namespace App\Exceptions;

use App\Dtos\GenericDto;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, $exception)
    {
        $data = null;
        switch (get_class($exception)) {
            case 'MethodNotAllowedHttpException':
                $code = 400;
                $message = $exception->getMessage();
                $internalCode = '4002';
                break;
            case 'Illuminate\Validation\ValidationException':
                $code = 400;
                $message = $exception->getMessage();
                $data = $exception->errors();
                $internalCode = '4001';
                break;
            case 'Illuminate\Database\Eloquent\ModelNotFoundException':
                $code = 404;
                $message = 'Param not found';
                $params = explode("\\", $exception->getModel());

                $data = [array_pop($params)  => $exception->getIds()];
                $internalCode = 4000;
                break;
            case 'NotFoundHttpException':
                $code = '404';
                $message = $exception->getMessage();
                $internalCode = 4000;
                break;
            case 'Illuminate\Validation\UnauthorizedException':
                $code = '401';
                $message = !empty($exception->getMessage()) ? $exception->getMessage()  : 'Unauthorized';
                $internalCode = 4003;
                break;
            default:
                $code = '500';
                $internalCode = 5001;
                $message = $exception->getMessage() ?? '';
                break;
        }
        return (new GenericDto)->errorMessage($message, $data, $internalCode, $code)->getMessageDTO();
    }
}
