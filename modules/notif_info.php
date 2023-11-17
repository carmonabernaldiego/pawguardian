<?php
if (!empty($_SESSION['msgbox_info']) == 1) {
    echo '
            <div class="box-notification-ok alert alert-success alert-dismissible fade show" role="alert">
                ' . $_SESSION['text_msgbox_info'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        ';
}
if (!empty($_SESSION['msgbox_error']) == 1) {
    echo '
            <div class="box-notification-ok alert alert-danger alert-dismissible fade show" role="alert">
                ' . $_SESSION['text_msgbox_error'] . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        ';
}