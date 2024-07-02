<?php
class RatingModel extends CI_Model
{
    public function get_rating($product_id)
    {
        $data = $this->db->query("SELECT AVG(rate) as rate FROM ratings WHERE product_id = '$product_id'");
        return $data->result_array()[0]['rate'] ?? 0;
    }

    public function is_rated($product_id, $user_id)
    {
        //must return true or false
        $data = $this->db->query("SELECT * FROM ratings WHERE product_id = '$product_id' AND user_id = '$user_id'");
        return $data->num_rows() > 0;
    }

    public function give_rating($product_id, $user_id, $rate)
    {
        $data = $this->db->query("INSERT INTO ratings (product_id, user_id, rate) VALUES ('$product_id', '$user_id', '$rate')");
        return $data;
    }

    // NGUBAH
    public function get_user($product_id)
    {
        $data = $this->db->query("SELECT count(user_id) as user_id FROM ratings WHERE product_id = '$product_id'");
        return $data->result_array()[0]['user_id'] ?? 0;
    }
    public function rata($product_id)
    {
        $query = $this->db->select('user_id, rate')
            ->where('product_id', $product_id)
            ->get('ratings');

        $rates = [];
        $total_rate = 0;
        $count = 0;

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $rate = $row['rate'];
                $rates[] = $rate;
                $total_rate += $rate;
                $count++;
            }
        }

        $average_rate = ($count > 0) ? $total_rate / $count : 0;

        $numerator = 0;
        $denominatorX = 0;
        $denominatorY = 0;

        foreach ($rates as $rate) {
            $numerator += ($rate - $average_rate) * ($rate - $average_rate);
            $denominatorX += ($rate - $average_rate) * ($rate - $average_rate);
            $denominatorY += ($rate - $average_rate) * ($rate - $average_rate);
        }

        $denominator = sqrt($denominatorX) * sqrt($denominatorY);
        $pearson_correlation = ($denominator != 0) ? $numerator / $denominator : 0;

        return [
            'total_rate' => $total_rate,
            'count' => $count,
            'average_rate' => $average_rate,
            'Kuadrat' => pow($total_rate - $average_rate, 2),
            'Pearson_Correlation' => $pearson_correlation
        ];
    }

    public function similarity($product, $all_products, $useridd)
    {
        $tampData = [];

        foreach ($all_products as $key => $p) {
            $query = $this->db->select('user_id, rate, product_id')
                ->where('product_id', $p)
                ->get('ratings');

            $rates = [];
            $iduser = [];
            $total_rate = 0;
            $total_users = 0;

            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $rate = $row['rate'];
                    $rates[] = $rate;
                    $iduser[] = $row['user_id'];
                    $total_rate += $rate;
                    $total_users++;
                }
            }

            $avg_rate = ($total_users > 0) ? $total_rate / $total_users : 0;

            $tampData[$key]['product_id'] = $p;
            $tampData[$key]['rating'] = $rates;
            $tampData[$key]['rata2'] = $avg_rate;
            $tampData[$key]['total_rate'] = $total_rate;
            $tampData[$key]['total_user'] = $total_users;
            $tampData[$key]['id_user'] = $iduser;
            $tampData[$key]['kuadrat'] = pow($total_rate - $avg_rate, 2);
        }

        // Menghitung similarity
        foreach ($tampData as $k => $prodK) {
            foreach ($tampData as $l => $prodL) {
                $sumRuKMinusRk = 0;
                $sumRuLMinusRl = 0;
                $sumRuK = 0;
                $sumRuL = 0;

                foreach ($prodK['id_user'] as $index => $userId) {
                    if (in_array($userId, $prodL['id_user'])) {
                        $indexProdL = array_search($userId, $prodL['id_user']);

                        $sumRuKMinusRk += ($prodK['rating'][$index] - $prodK['rata2']);
                        $sumRuLMinusRl += ($prodL['rating'][$indexProdL] - $prodL['rata2']);

                        $sumRuK += pow($prodK['rating'][$index] - $prodK['rata2'], 2);
                        $sumRuL += pow($prodL['rating'][$indexProdL] - $prodL['rata2'], 2);
                    }
                }

                $similarity = 0;
                if ($sumRuK != 0 && $sumRuL != 0) {
                    $similarity = ($sumRuKMinusRk * $sumRuLMinusRl) / (sqrt($sumRuK) * sqrt($sumRuL));
                }

                $tampData[$k]['similarity'][$l] = $similarity;
            }
        }

        $mae = 0;
        $totalAbsoluteError = 0;
        $totalRatings = 0;

        foreach ($tampData as $k => $prodK) {
            if ($prodK['product_id'] === $product) {
                foreach ($tampData as $l => $prodL) {
                    if ($prodL['product_id'] === $product) continue;

                    $prediction = $prodK['rata2'];
                    if (isset($prodK['similarity'][$l])) {
                        $prediction += ($prodL['rata2'] - $prodK['rata2']) * $prodK['similarity'][$l];
                        $totalAbsoluteError += abs($prodL['rata2'] - $prediction);
                        $totalRatings++;
                    }
                }
            }
        }

        if ($totalRatings > 0) {
            $mae = $totalAbsoluteError / $totalRatings;
        }

        return $mae;
        // Mengembalikan nilai MAE
    }


    // public function similarity($product, $all_products)
    // {
    //     $product_ratings = [];
    //     $product_avg = [];
    //     $total_rates = [];
    //     $count = [];

    //     // Mengumpulkan nilai rate untuk setiap produk dan menghitung rata-ratanya
    //     foreach ($all_products as $p) {
    //         $query = $this->db->select('user_id, rate')
    //             ->where('product_id', $p)
    //             ->get('ratings');

    //         $rates = [];
    //         $total_rate = 0;
    //         $total_users = 0;

    //         if ($query->num_rows() > 0) {
    //             foreach ($query->result_array() as $row) {
    //                 $rate = $row['rate'];
    //                 $rates[] = $rate;
    //                 $total_rate += $rate;
    //                 $total_users++;
    //             }
    //         }

    //         $avg_rate = ($total_users > 0) ? $total_rate / $total_users : 0;

    //         $product_ratings[$p] = $rates;
    //         $product_avg[$p] = $avg_rate;
    //         $total_rates[$p] = $total_rate;
    //         $count[$p] = $total_users;
    //     }

    //     $similarity = [];

    //     // Menghitung similarity antara produk yang diberikan dengan produk lainnya
    //     foreach ($all_products as $other_product) {
    //         if ($other_product != $product) {
    //             $numerator = 0;
    //             $denominatorX = 0;
    //             $denominatorY = 0;

    //             $m = min(count($product_ratings[$product]), count($product_ratings[$other_product]));

    //             for ($u = 0; $u < $m; $u++) {
    //                 $numerator += ($product_ratings[$product][$u] - $product_avg[$product]) * ($product_ratings[$other_product][$u] - $product_avg[$other_product]);
    //                 $denominatorX += pow(($product_ratings[$product][$u] - $product_avg[$product]), 2);
    //                 $denominatorY += pow(($product_ratings[$other_product][$u] - $product_avg[$other_product]), 2);
    //             }

    //             $denominator = sqrt($denominatorX) * sqrt($denominatorY);
    //             $similarity[$other_product] = ($denominator != 0) ? $numerator / $denominator : 0;
    //         }
    //     }

    //     return $similarity[$product];
    // }
    public function predict($user_id, $product_id, $all_products)
    {
        // Menghitung similarity antara produk
        $similarities = $this->similarity($product_id, $all_products);

        // Menghitung rata-rata nilai rating untuk produk yang diberikan
        $query = $this->db->select_avg('rate')
            ->where('product_id', $product_id)
            ->get('ratings');

        $product_avg = ($query->num_rows() > 0) ? $query->row()->rate : 0;

        // Mengumpulkan nilai rating user untuk setiap produk
        $user_ratings = [];
        foreach ($all_products as $p) {
            $query = $this->db->select('rate')
                ->where('product_id', $p)
                ->where('user_id', $user_id)
                ->get('ratings');

            $user_rate = ($query->num_rows() > 0) ? $query->row()->rate : 0;
            $user_ratings[$p] = $user_rate;
        }

        $numerator = 0;
        $denominator = 0;

        foreach ($all_products as $l) {
            if ($l != $product_id) {
                $numerator += ($user_ratings[$l] - $product_avg) * $similarities[$l];
                $denominator += abs($similarities[$l]);
            }
        }

        if ($denominator != 0) {
            $prediction = $product_avg + ($numerator / $denominator);
        } else {
            $prediction = "Tidak dapat melakukan perhitungan karena denominator adalah nol.";
        }
        return $prediction;
    }
}
