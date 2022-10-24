<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php include "../include/link.php" ?>
</head>
<body>
    <div id="skip">
        <a href="#header">헤더 영역 바로가기</a>
        <a href="#main">컨텐츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>
    <!-- skip -->

    <?php include "../include/header.php" ?>
    <!-- header -->
    <main id="main">
        <section id="board" class="container">
            <h2>게시판 보기 영역입니다.</h2>
            <div class="board__inner">
                <div class="board__title">
                    <h3>게시판</h3>
                    <p>웹디자이너, 웹퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.</p>
                </div>
                <div class="board__view">
                    <table>
                        <colgroup>
                            <col style="width: 20%">
                            <col style="width: 80%">
                        </colgroup>
                        <tbody>
<?php
    $myBoardID = $_GET['myBoardID'];

    // echo $myBoardID;
    //보드뷰 + 1 (update)
    $sql = "UPDATE myboard SET boardview = boardview + 1 WHERE myBoardID = {$myBoardID}";
    $connect -> query($sql);

    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardview, b.boardContents FROM myBoard b JOIN myMember m ON(m.myMemberID = b.myMemberID) WHERE b.myBoardID = {$myBoardID}";
    $result = $connect -> query($sql);

    


    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        // echo "<pre>";
        // var_dump($info);
        // echo "</pre>";

        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('T-m-d H:i', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardview']."</td></tr>";
        echo "<tr><th>내용</th><td class='height'>".$info['boardContents']."</td></tr>";
    }
?>
                            <!-- <tr>
                                <th>제목</th>
                                <td>게시판 제목입니다.</td>
                            </tr>
                            <tr>
                                <th>등록자</th>
                                <td>어묵</td>
                            </tr>
                            <tr>
                                <th>등록일</th>
                                <td>2022-09-22</td>
                            </tr>
                            <tr>
                                <th>조회수</th>
                                <td>142</td>
                            </tr>
                            <tr>
                                <th>내용</th>
                                <td class="height">
                                    상황을 가장 잘 활용하는 사람이 가장 좋은 상황을 맞는다. – 존 우든 <br>
                                    창조적인 삶을 살려면 내가 틀릴지도 모른다는 공포를 버려야 한다. – 미상 <br>
                                    일반적인 것을 잃을 위험을 감수하지 않으면 평범한 것에 만족해야 한다. – 짐 론 <br>
                                    신뢰의 이유는 안전하거나 확실해서가 아니라, 위험을 감수할 용의가 있어서이다. – 미상 <br>
                                    큰 목표를 이루고 싶으면 허락을 구하지 마라. – 미상 <br>
                                    한 가지 생각을 선택하라. 그 생각을 당신의 삶으로 만들어라. 그걸 생각하고, 꿈꾸고, 그에 기반해서 살아가라. 당신의 몸의 모든 부분, 뇌, 근육,
                                    신경을 그 생각으로 가득 채우고 다른 생각은 다 내버려둬라. 이것이 성공하는 방법이다. – 스와미 비베카난다 <br>
                                    추구할 수 있는 용기가 있다면 우리의 모든 꿈은 이뤄질 수 있다. – 월트 디즈니 <br>
                                    기다리는 사람에게 좋은 일이 생기지만, 찾아나서는 사람에게는 더 좋은 일이 생긴다. – 미상 <br>
                                    늘 하던 대로 하면 늘 얻던 것을 얻는다. – 미상 <br>
                                    열정을 잃지 않고 실패에서 실패로 걸어가는 것이 성공이다. – 윈스턴 처칠 <br>
                                    애벌레가 세상이 끝났다고 생각하는 순간 나비로 변했다. - 속담
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <div class="board__btn">
                    <a href="boardModify.php?myBoardID=<?=$myBoardID?>">수정하기</a>
                    <a href="boardRemove.php?myBoardID=<?=$myBoardID?>" onClick="alert('정말 삭제하시겠습니까?')">삭제하기</a>
                    <a href="board.php">목록보기</a>
                </div>
            </div>
        </section>
        <!-- board -->
    </main>

    <?php include "../include/footer.php" ?>
    <!-- footer -->

    <?php include "../login/login.php" ?>
    <!-- login -->

    <script src="../assets/js/custom.js"></script>
</body>
</html>