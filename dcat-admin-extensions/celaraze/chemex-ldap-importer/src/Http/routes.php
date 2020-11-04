<?php

use Celaraze\ChemexLDAPImporter\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('chemex-ldap-importer', Controllers\ChemexLdapImporterController::class.'@index');