<?php
$dbh = getDB();

// Load lookup tables for dropdowns
$namingOptions = $dbh->query("SELECT id, nev FROM naming ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
$extentOptions = $dbh->query("SELECT id, nev FROM extent ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);

// --------------------------------------------------------
// DELETE
// --------------------------------------------------------
if (isset($_POST['crud_action']) && $_POST['crud_action'] === 'delete' && isset($_POST['delete_id']) && is_numeric($_POST['delete_id'])) {
    try {
        $stmt = $dbh->prepare("DELETE FROM restriction WHERE id = :id");
        $stmt->execute([':id' => $_POST['delete_id']]);
        $crudSuccess = 'Record deleted successfully.';
    } catch (PDOException $e) {
        $crudError = 'Delete failed: ' . $e->getMessage();
    }
}

// --------------------------------------------------------
// LOAD RECORD FOR EDITING
// --------------------------------------------------------
$editRecord = null;
if (isset($_POST['crud_action']) && $_POST['crud_action'] === 'edit_load' && isset($_POST['edit_id']) && is_numeric($_POST['edit_id'])) {
    $stmt = $dbh->prepare("SELECT * FROM restriction WHERE id = :id");
    $stmt->execute([':id' => $_POST['edit_id']]);
    $editRecord = $stmt->fetch(PDO::FETCH_ASSOC);
}

// --------------------------------------------------------
// CREATE
// --------------------------------------------------------
if (isset($_POST['crud_action']) && $_POST['crud_action'] === 'create') {
    $errors = validateRestriction($_POST);
    if (!empty($errors)) {
        $crudError = implode(' ', $errors);
    } else {
        try {
            $sql = "INSERT INTO restriction (roadnumber, frompoint, topoint, settlement, fromwhen, towhen, namingid, extentid, speed)
                    VALUES (:roadnumber, :frompoint, :topoint, :settlement, :fromwhen, :towhen, :namingid, :extentid, :speed)";
            $stmt = $dbh->prepare($sql);
            $stmt->execute(buildParams($_POST));
            $crudSuccess = 'Record added successfully.';
        } catch (PDOException $e) {
            $crudError = 'Insert failed: ' . $e->getMessage();
        }
    }
}

// --------------------------------------------------------
// UPDATE
// --------------------------------------------------------
if (isset($_POST['crud_action']) && $_POST['crud_action'] === 'update') {
    $errors = validateRestriction($_POST);
    if (!empty($errors)) {
        $crudError = implode(' ', $errors);
        // Reload edit record with posted data for re-display
        $editRecord = $_POST;
    } else {
        try {
            $sql = "UPDATE restriction SET
                        roadnumber = :roadnumber,
                        frompoint  = :frompoint,
                        topoint    = :topoint,
                        settlement = :settlement,
                        fromwhen   = :fromwhen,
                        towhen     = :towhen,
                        namingid   = :namingid,
                        extentid   = :extentid,
                        speed      = :speed
                    WHERE id = :id";
            $stmt = $dbh->prepare($sql);
            $params = buildParams($_POST);
            $params[':id'] = $_POST['id'];
            $stmt->execute($params);
            $crudSuccess = 'Record updated successfully.';
            $editRecord  = null;
        } catch (PDOException $e) {
            $crudError = 'Update failed: ' . $e->getMessage();
        }
    }
}

// --------------------------------------------------------
// FETCH ALL RECORDS
// --------------------------------------------------------
try {
    $sql = "SELECT r.*, n.nev AS naming_text, e.nev AS extent_text
            FROM restriction r
            LEFT JOIN naming n ON r.namingid = n.id
            LEFT JOIN extent e ON r.extentid = e.id
            ORDER BY r.id DESC";
    $restrictions = $dbh->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $restrictions = [];
    $crudError = 'Failed to load records: ' . $e->getMessage();
}

// --------------------------------------------------------
// HELPER FUNCTIONS
// --------------------------------------------------------
function validateRestriction($data) {
    $errors = [];
    if (empty($data['roadnumber']) || !is_numeric($data['roadnumber'])) {
        $errors[] = 'Road number must be a valid number.';
    }
    if (empty($data['frompoint'])) {
        $errors[] = 'From point is required.';
    }
    if (empty($data['topoint'])) {
        $errors[] = 'To point is required.';
    }
    if (empty($data['settlement'])) {
        $errors[] = 'Settlement is required.';
    }
    if (empty($data['fromwhen'])) {
        $errors[] = 'From date is required.';
    }
    if (empty($data['towhen'])) {
        $errors[] = 'To date is required.';
    }
    if (!empty($data['fromwhen']) && !empty($data['towhen']) && $data['fromwhen'] > $data['towhen']) {
        $errors[] = 'From date cannot be later than To date.';
    }
    if (empty($data['namingid']) || !is_numeric($data['namingid'])) {
        $errors[] = 'Please select a restriction type.';
    }
    if (empty($data['extentid']) || !is_numeric($data['extentid'])) {
        $errors[] = 'Please select a closure extent.';
    }
    if (!empty($data['speed']) && !is_numeric($data['speed'])) {
        $errors[] = 'Speed must be a number.';
    }
    return $errors;
}

function buildParams($data) {
    return [
        ':roadnumber' => (int) $data['roadnumber'],
        ':frompoint'  => trim($data['frompoint']),
        ':topoint'    => trim($data['topoint']),
        ':settlement' => trim($data['settlement']),
        ':fromwhen'   => $data['fromwhen'],
        ':towhen'     => $data['towhen'],
        ':namingid'   => (int) $data['namingid'],
        ':extentid'   => (int) $data['extentid'],
        ':speed'      => !empty($data['speed']) ? (int) $data['speed'] : null,
    ];
}
?>