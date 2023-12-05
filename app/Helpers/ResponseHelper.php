<?php

if ( !function_exists( 'ok' ) )
{
    /**
     * Return a ok 200 response
     */
    function ok( $message, $data = null, $status_code = 200, $success = true )
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'data'    => $data,
        ];
        return response()->json( $response, $status_code );
    }
}

if ( !function_exists( 'error' ) )
{
    /**
     * Return a error 400 response
     */
    function error( $message, $data = null, $status_code = 400 )
    {
        return ok( $message, $data, $status_code, false );
    }
}