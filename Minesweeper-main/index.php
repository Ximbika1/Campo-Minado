<?php
    session_start();
    if(isset($_GET['exit'])){
        session_destroy();
        header("Location: login.php");
    }
    if(!isset($_SESSION['userData'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Campo minado</title>
        <meta charset="utf-8" />
        <link href="css/game.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header class="menu">
            <nav>
                <?php
                    echo '<div id="username">'.$_SESSION['userData']['nome'].'</div>';
                ?>
                <div class="menu-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                        <path
                            d="M 0 7.5 L 0 12.5 L 50 12.5 L 50 7.5 Z M 0 22.5 L 0 27.5 L 50 27.5 L 50 22.5 Z M 0 37.5 L 0 42.5 L 50 42.5 L 50 37.5 Z" />
                    </svg>
                    <span>Menu</span>
                </div>
                <div class="modal-frame">
                    <div class="menu-items">
                        <ul>
                            <li><a href="perfil.php">Perfil</a></li>
                            <li><a href="ranking.php">Ranking</a></li>
                            <li><a href="index.php?exit">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <div class="content">
            <div>
                <div id="game">
                    <header class="config">
                        <!-- Como ainda não é para ter JS, resolvi implementar esse componente usando o select -->
                        <div class="config-item">
                            <span>Dificuldade:</span>
                            <select id="dropdownLevel" class="dropdown">
                                <option value="0">Iniciante</option>
                                <option value="1">Facil</option>
                                <option value="2" selected>Medio</option>
                                <option value="3">Dificil</option>
                                <option value="4">Expert</option>
                            </select>
                        </div>
                        <div class="game-guide">
                            <img src="./images/hourglass.svg" alt="Ampuleta" />
                            <span id="minutes">00</span>:<span id="seconds">00</span>
                        </div>
                        <div class="game-guide">
                            <img src="./images/bomb.svg" alt="Bomba" />
                            <span id="bombCount">40</span>
                        </div>
                        <div class="config-item">
                            <span>Modalidade:</span>
                            <select id="dropdown" class="dropdown">
                                <option value="0" selected>Normal</option>
                                <option value="1">Rivotril</option>
                            </select>
                        </div>
                    </header>
                    <div id="game-content">
                        <div>
                            <div class="board">
                                <div class="row">
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                </div>
                                <div class="row">
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                </div>
                                <div class="row">
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                </div>
                                <div class="row">
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                </div>
                                <div class="row">
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                </div>
                                <div class="row">
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                </div>
                                <div class="row">
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                </div>
                                <div class="row">
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                </div>
                                <div class="row">
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                </div>
                                <div class="row">
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                </div>
                                <div class="row">
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                </div>
                                <div class="row">
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                </div>
                                <div class="row">
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                </div>
                                <div class="row">
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                    <div class="square2"></div>
                                    <div class="square"></div>
                                </div>
                            </div>
                            <span class="lines">14</span>
                        </div>
                        <div class="columns">18</div>
                    </div>
                </div>
                <div class="modal-start">
                    <div class="button-start">Jogar</div>
                </div>
            </div>
            <div id="log" class="log">
                <div class="cheating"><span>Trapaça</span></div>
                <div class="header">Histórico</div>
                <div class="log-content">
                </div>
            </div>
        </div>
        <script src="js/Square.js"></script>
        <script src="js/Board.js"></script>
        <script src="js/Game.js"></script>
        <script src="js/logView.js"></script>
        <script src="js/IndexView.js"></script>
    </body>
</html>