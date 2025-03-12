<?php
if (! function_exists('OptionAgama')) {
    function OptionAgama($selected = '')
    {
        $agama = \Illuminate\Support\Facades\DB::table('agama')->get();
        $opt = '<option value="">Pilih Salah Satu</option>';
        foreach ($agama as $va) {
            $sel = $va->id == $selected ? 'selected' : '';
            $opt .= '<option value="' . $va->id . '" ' . $sel . '>' . $va->nama . '</option>';
        }
        return $opt;
    }
}

if (! function_exists('OptionCreate')) {
    function OptionCreate($Key, $Name, $Selected)
    {

        $data = '';

        $Jumlah = count($Key);

        if ($Jumlah > 0) {

            for ($i = 0; $i < $Jumlah; $i++) {

                $selected = $Key[$i] == $Selected ? "selected" : "";

                $data .= '<option value ="' . $Key[$i] . '" ' . $selected . '>' . $Name[$i] . '</option>';
            }
        } else {

            $data .= '<option =""></option>';
        }

        return $data;
    }
}


if (! function_exists('monthOptions')) {
    function monthOptions($selected)
    {
        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $options = '';
        foreach ($months as $key => $month) {
            $isSelected = $selected == $key ? 'selected' : '';
            $options .= "<option value=" . $key . " $isSelected>$month</option>";
        }

        return $options;
    }
}
