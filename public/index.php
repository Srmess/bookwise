<?php

require '../models/livro.model.php';
require '../models/user.model.php';
require '../models/review.model.php';


session_start();

require '../Flash.php';
require '../functions.php';

$config = require '../config.php';

require '../Database.php';
require '../routes.php';
