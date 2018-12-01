<?php

namespace App\Controllers\Views;

use DSisconeto\Simple\Request;

Request::route("/", "ViewHome@index");