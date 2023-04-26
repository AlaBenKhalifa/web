<?php

include 'C:/xampp/htdocs/web/config.php';
include 'C:/xampp/htdocs/web/Model/Coupon.php';

class CouponC
{
    
    public function verifycoupon($id)
    {
        $sql = "SELECT * FROM coupon WHERE IDCoupon = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $coupon = $query->fetch();
            if (!$coupon) {
                echo '<script>alert("This coupon does not exist")</script>';
                return false;
            }
            else
            {
                $sql = "SELECT coupon.Number - COUNT(ticket.IDCoupon) as usage_count 
                FROM coupon 
                LEFT JOIN ticket ON coupon.IDCoupon = ticket.IDCoupon WHERE coupon.IDCoupon = $id
                GROUP BY coupon.IDCoupon";
                $db = config::getConnexion();
                $liste = $db->query($sql);
                foreach ($liste as $coupon) {
                    if ($coupon['usage_count'] == 0)
                    {
                        echo "<script> alert('this coupon is not available anymore') </script>";
                        return false;
                    }
                    else
                        return true;
                }
            }
            return true; // coupon exists
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function listCoupon()
    {
        $sql = "SELECT coupon.IDCoupon,coupon.NomInf,coupon.Number,coupon.Percentage ,coupon.number-COUNT(ticket.IDCoupon) as usage_count 
        FROM coupon 
        LEFT JOIN ticket ON coupon.IDCoupon = ticket.IDCoupon WHERE coupon.IDCoupon != 0
        GROUP BY coupon.IDCoupon";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function showCoupon($id)
    {
        $sql = "SELECT * from coupon where IDCoupon = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $coupon = $query->fetch();
            return $coupon;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function addCoupon($coupon)
    {
        $sql = "INSERT INTO coupon 
        VALUES (:idc,:ni,:num,:per)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':idc' => $coupon->getIDCoupon(),
                ':ni' => $coupon->getNomInf(),
                ':num' => $coupon->getNumber(),
                ':per' => $coupon->getPercentage()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateCoupon($coupon, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE coupon SET
                    NomInf = :ni,
                    Number = :num,
                    Percentage = :per
                WHERE IDCoupon = :id'
            );
            $query->execute([
                'id' => $id,
                'ni' => $coupon->getNomInf(),
                'num' => $coupon->getNumber(),
                'per' => $coupon->getPercentage()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function deleteCoupon($id)
    {
        $sql = "DELETE FROM coupon WHERE IDCoupon = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
