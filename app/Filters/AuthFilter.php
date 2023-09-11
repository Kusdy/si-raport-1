<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $userRole = session()->get('role');

        $uri = service('uri');
        $requestedPage = $uri->getSegment(1);

        $allowedPagesWithoutRoleCheck = ['logout'];

        $allowedPages = [
            'Admin' => ['admin', 'admin/dashboard'],
            'Guru' => ['guru', 'guru/dashboard'],
            'Siswa' => ['siswa', 'siswa/dashboard'],
            'Wali kelas' => ['wakel', 'wakel/dashboard'],
            'Kepala sekolah' => ['kepsek', 'kepsek/dashboard'],
        ];

        if (!in_array($requestedPage, $allowedPagesWithoutRoleCheck) && !in_array($requestedPage, $allowedPages[$userRole])) {
            $userRole = strtolower($userRole);
            return redirect()->to($userRole . '/dashboard')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini');
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan yang dilakukan setelah permintaan
    }
}
