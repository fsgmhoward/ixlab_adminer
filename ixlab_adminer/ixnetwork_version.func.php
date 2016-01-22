<?php
/*This library is published under MIT License
  Copyright (C) 2016 Howard Liu

  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
  documentation files (the "Software"), to deal in the Software without restriction, including without limitation
  the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
  and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
  The above copyright notice and this permission notice shall be included in all copies or substantial portions
  of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
  TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
  THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
  CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
  DEALINGS IN THE SOFTWARE.
 */
/*
 * Version 1.0, finished on Jan 22, 2016
 * Author: Howard Liu
 * Author's Address: https://blog.ixnet.work
 */
function ixnetwork_version($appName, $currentVersion){
    $remoteVersion = file_get_contents('http://version.ixnet.work/'.$appName);
    if($remoteVersion == '404')
        //No such app is found
        return array('Error'=>404);
    if($remoteVersion != $currentVersion)
        return array(
            'Error' => false,
            'IsUpToDate' => false,
            'CurrentVersion' => $currentVersion,
            'RemoteVersion' => $remoteVersion,
        );
    else
        return array(
            'Error' => false,
            'IsUpToDate' => true,
            'CurrentVersion' => $currentVersion,
            'RemoteVersion' => $remoteVersion,
        );
}