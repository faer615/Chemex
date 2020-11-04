<?php

namespace Celaraze\ChemexLDAPImporter\Http\Controllers;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;

class ChemexLdapImporterController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(Admin::view('celaraze.chemex-ldap-importer::index'));
    }
}