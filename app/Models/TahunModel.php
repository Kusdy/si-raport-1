<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\SemesterModel;

class TahunModel extends Model
{
    protected $table = 'tb_tahun_ajar';
    protected $primaryKey = 'id_thn_ajar';
    protected $allowedFields = ['id_semester', 'tahun'];

    public function getSelectSemester()
    {
        $semesterModel = new SemesterModel();
        $semester = $semesterModel->findAll();

        $options = [];
        foreach ($semester as $row) {
            $semester_label = $row['semester'] . ' - ' . $row['ket_semester'];
            $options[$row['id_semester']] = $semester_label;
        }

        return $options;
    }
}
