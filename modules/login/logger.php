<?php
if (!empty($_POST['txtuser']) and !empty($_POST['txtpass'])) {
    //Eliminar espacios en blanco
    $_POST['txtuser'] = trim($_POST['txtuser']);
    //Limpiar String
    $user = mysqli_real_escape_string($conexion, $_POST['txtuser']);
    $pass = mysqli_real_escape_string($conexion, $_POST['txtpass']);

    //Buscar Usuario
    $sql = "SELECT user, permissions, email, image FROM users WHERE BINARY user = '$user' and BINARY pass = '$pass' or BINARY email = '$user' and BINARY pass = '$pass' LIMIT 1";

    if ($result = $conexion->query($sql)) {
        if ($row = mysqli_fetch_array($result)) {
            //Cargar Usuario
            if ($row['permissions'] == 'admin') {
                $user = $row['user'];
                $email = $row['email'];
                $permissions = $row['permissions'];
                $image = $row['image'];

                $sql = "SELECT name, surnames FROM administratives WHERE user = '$user' LIMIT 1";

                if ($result = $conexion->query($sql)) {
                    if ($row = mysqli_fetch_array($result)) {
                        $name = $row['name'];
                        $surnames = $row['surnames'];

                        $sql = "SELECT school_period FROM school_periods WHERE active = 1 AND current = 1 LIMIT 1";

                        if ($result = $conexion->query($sql)) {
                            if ($row = mysqli_fetch_array($result)) {
                                $school_period = $row['school_period'];
                            }
                        }
                    } else {
                        goto error_user;
                    }

                    if (!empty($_POST['remember_session'])) {
                        $_SESSION['section-admin'] = setcookie('section-admin', 'section-admin-' . $user, time() + 365 * 24 * 60 * 60);
                    } else {
                        $_SESSION['section-admin'] = 'section-admin-' . $user;
                    }
                }
            } elseif ($row['permissions'] == 'editor') {
                $user = $row['user'];
                $email = $row['email'];
                $permissions = $row['permissions'];
                $image = $row['image'];

                $sql = "SELECT name, surnames FROM administratives WHERE user = '$user' LIMIT 1";

                if ($result = $conexion->query($sql)) {
                    if ($row = mysqli_fetch_array($result)) {
                        $name = $row['name'];
                        $surnames = $row['surnames'];

                        $sql = "SELECT school_period FROM school_periods WHERE active = 1 AND current = 1 LIMIT 1";

                        if ($result = $conexion->query($sql)) {
                            if ($row = mysqli_fetch_array($result)) {
                                $school_period = $row['school_period'];
                            }
                        }
                    } else {
                        goto error_user;
                    }

                    if (!empty($_POST['remember_session'])) {
                        $_SESSION['section-editor'] = setcookie('section-editor', 'section-editor-' . $user, time() + 365 * 24 * 60 * 60);
                    } else {
                        $_SESSION['section-editor'] = 'section-editor-' . $user;
                    }
                }
            } elseif ($row['permissions'] == 'teacher') {
                $user = $row['user'];
                $email = $row['email'];
                $permissions = $row['permissions'];
                $image = $row['image'];

                $sql = "SELECT name, surnames FROM teachers WHERE user = '$user' LIMIT 1";

                if ($result = $conexion->query($sql)) {
                    if ($row = mysqli_fetch_array($result)) {
                        $name = $row['name'];
                        $surnames = $row['surnames'];

                        $sql = "SELECT school_period FROM school_periods WHERE active = 1 AND current = 1 LIMIT 1";

                        if ($result = $conexion->query($sql)) {
                            if ($row = mysqli_fetch_array($result)) {
                                $school_period = $row['school_period'];
                            }
                        }
                    } else {
                        goto error_user;
                    }

                    if (!empty($_POST['remember_session'])) {
                        $_SESSION['section-teacher'] = setcookie('section-teacher', 'section-teacher-' . $user, time() + 365 * 24 * 60 * 60);
                    } else {
                        $_SESSION['section-teacher'] = 'section-teacher-' . $user;
                    }
                }
            } elseif ($row['permissions'] == 'student') {
                $user = $row['user'];
                $email = $row['email'];
                $permissions = $row['permissions'];
                $image = $row['image'];

                $sql = "SELECT name, surnames FROM students WHERE user = '$user' LIMIT 1";

                if ($result = $conexion->query($sql)) {
                    if ($row = mysqli_fetch_array($result)) {
                        $name = $row['name'];
                        $surnames = $row['surnames'];

                        $sql = "SELECT school_period FROM school_periods WHERE active = 1 AND current = 1 LIMIT 1";

                        if ($result = $conexion->query($sql)) {
                            if ($row = mysqli_fetch_array($result)) {
                                $school_period = $row['school_period'];
                            }
                        }
                    } else {
                        goto error_user;
                    }

                    if (!empty($_POST['remember_session'])) {
                        $_SESSION['section-student'] = setcookie('section-student', 'section-student-' . $user, time() + 365 * 24 * 60 * 60);
                    } else {
                        $_SESSION['section-student'] = 'section-student-' . $user;
                    }
                }
            }

            //Cargar datos sesión usuario COOKIE
            if (!empty($_POST['remember_session'])) {
                setcookie('remember', 'si', time() + 15 * 24 * 60 * 60);
                setcookie('user', $user, time() + 15 * 24 * 60 * 60);
                setcookie('name', $name, time() + 15 * 24 * 60 * 60);
                setcookie('surnames', $surnames, time() + 15 * 24 * 60 * 60);
                setcookie('email', $email, time() + 15 * 24 * 60 * 60);
                setcookie('image', $image, time() + 15 * 24 * 60 * 60);
                setcookie('permissions', $permissions, time() + 15 * 24 * 60 * 60);
                setcookie('school_period', $school_period, time() + 15 * 24 * 60 * 60);
                setcookie('authenticate', 'go-' . $user, time() + 15 * 24 * 60 * 60);

                header('Location: home');
            } else {
                $_SESSION['user'] = $user;
                $_SESSION['name'] = $name;
                $_SESSION['surnames'] = $surnames;
                $_SESSION['email'] = $email;
                $_SESSION['image'] = $image;
                $_SESSION['permissions'] = $permissions;
                $_SESSION['school_period'] = $school_period;
                $_SESSION['authenticate'] = 'go-' . $user;

                header('Location: /home');
            }
        } else {
            error_user:
            echo '
                    <div class="form-group">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>La combinación de correo electrónico y contraseña es incorrecta
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
                        <label for="txtuser">Correo electrónico</label>
                        <input type="email" name="txtuser" class="form-control" id="txtuser" placeholder="Correo electrónico">
                      </div>
                      <div class="form-group">
                        <label for="txtpass">Contraseña</label>
                        <input type="password" name="txtpass" class="form-control" id="txtpass"
                          autocomplete="current-password" placeholder="Contraseña">
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          Recuérdame
                        </label>
                      </div>
                      <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                          <i class="btn-icon-prepend" data-feather="log-in"></i>
                          Entrar
                        </button>
                      </div>
                ';
        }
    }
} else {
    echo '
    <div class="form-group">
                        <label for="txtuser">Correo electrónico</label>
                        <input type="email" name="txtuser" class="form-control" id="txtuser" placeholder="Correo electrónico">
                      </div>
                      <div class="form-group">
                        <label for="txtpass">Contraseña</label>
                        <input type="password" name="txtpass" class="form-control" id="txtpass"
                          autocomplete="current-password" placeholder="Contraseña">
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input">
                          Recuérdame
                        </label>
                      </div>
                      <div class="mt-3">
                        <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                          <i class="btn-icon-prepend" data-feather="log-in"></i>
                          Entrar
                        </button>
                      </div>
		';
}