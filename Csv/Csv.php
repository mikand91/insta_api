<?php

class Csv
{

    public static function StoreDataToCsv($data )
    {

        $preparedData = Csv::PrepareDataForCsv(Csv::SortDataByLikes($data));

        $file = fopen('insta.csv', 'w');
        foreach ($preparedData as $field) {
            fputcsv($file, $field);
        }
        fclose($file);
        header("Location: ?thankyou");

    }

    protected static function PrepareDataForCsv($data)
    {
        $dataForCsv = array();
        $i = 0;
        foreach($data as $row)
        {
            $dataForCsv[$i]['id']=$row['id'];
            $dataForCsv[$i]['user']=$row['user']['username'];
            $dataForCsv[$i]['image']=$row['images']['standard_resolution']['url'];
            $dataForCsv[$i]['likes']=$row['likes']['count'];
            $i++;
        }

        return $dataForCsv;
    }

    protected static function SortDataByLikes($data)
    {

        $sortedByLikes = array();
        foreach ($data as $key => $row)
        {
            $sortedByLikes [$key] = $row['likes']['count'];
        }
        array_multisort($sortedByLikes , SORT_ASC, $data);

        return $data;
    }
}