<?php

include 'C:/xampp/htdocs/web/config.php';
include 'C:/xampp/htdocs/web/Model/Coupon.php';

class CouponC
{
    public function listCoupon()
    {
        $sql = "SELECT * FROM coupon";
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
