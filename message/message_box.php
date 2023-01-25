<?php
    if(isset($_SESSION['success_message'])){ ?>
        <div class="alert alert-success middle alert-dismissible fade show" role="alert">
            <strong><?php echo $_SESSION['success_message'] ?></strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
        <?php unset($_SESSION['success_message']);
    }

    if(isset($_SESSION['danger_message'])){ ?>
        <div class="alert alert-danger middle alert-dismissible fade show" role="alert">
            <strong><?php echo $_SESSION['danger_message'] ?></strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
        <?php unset($_SESSION['danger_message']);
    }

    if(isset($_SESSION['warning_message'])){ ?>
        <div class="alert alert-warning middle alert-dismissible fade show" role="alert">
            <strong><?php echo $_SESSION['warning_message'] ?></strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
        <?php unset($_SESSION['warning_message']);
    }

    if(isset($_SESSION['info_message'])){ ?>
        <div class="alert alert-info middle alert-dismissible fade show" role="alert">
            <strong><?php echo $_SESSION['info_message'] ?></strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
        <?php unset($_SESSION['info_message']);
    }
    
?>