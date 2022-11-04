// 01. HTML / CSS 디자인 구성
// 02. 클릭한 카드 뒤집기
// 03. 두개의 카드 뒤집어서 확인(첫 번째, 두 번째)

const memoryWrap = document.querySelector(".memory__wrap");
const memoryCard = document.querySelector(".memory__card");
const memoryCards = memoryWrap.querySelectorAll(".cards li");
const memoryStart = document.querySelector(".memory__start");
const memoryIntro = document.querySelector(".memory__intro");
const memoryRestart = document.querySelector(".memory__restart");
const memoryRestart2 = document.querySelector(".memory__restart2");

let cardOne, cardTwo;
let disableDeck = false;
let matchedCard = 0;
let oppunity = 3; // 기회

let sound = [
  "../assets/audio/right.m4a",
  "../assets/audio/error.m4a",
  "../assets/audio/up.mp3",
];
let soundMatch = new Audio(sound[0]);
let soundUnMatch = new Audio(sound[1]);
let soundSuccess = new Audio(sound[2]);

// 카드 뒤집기
function flipCard(e) {
  let clickedCard = e.target; // target으로 클릭한 정보 가져오기

  if (clickedCard !== cardOne && !disableDeck) {
    clickedCard.classList.add("flip");

    if (!cardOne) {
      return (cardOne = clickedCard);
    }

    cardTwo = clickedCard; // 클릭된 정보를 cardTwo에 저장
    disableDeck = true;

    let cardOneImg = cardOne.querySelector(".back img").src;
    let cardTwoImg = cardTwo.querySelector(".back img").src;

    matchCards(cardOneImg, cardTwoImg);
  }
}

// 카드 확인(두 개의 이미지 비교)
function matchCards(img1, img2) {
  if (img1 == img2) {
    // 같을 경우
    matchedCard++;
    document.querySelector(".memory__score").innerHTML = matchedCard;
    if (matchedCard == 8) {
      soundSuccess.play();
      memoryRestart2.style.transform = "scale(1)";
    }
    cardOne.removeEventListener("click", flipCard);
    cardTwo.removeEventListener("click", flipCard);
    cardOne = cardTwo = "";
    disableDeck = false;

    soundMatch.play();
  } else {
    // 일치하지 않은 경우(틀린음악, 이미지 좌우로  흔들림)
    setTimeout(() => {
      cardOne.classList.add("shakeX");
      cardTwo.classList.add("shakeX");
    }, 500);

    setTimeout(() => {
      cardOne.classList.remove("shakeX", "flip");
      cardTwo.classList.remove("shakeX", "flip");
      cardOne = cardTwo = "";
      disableDeck = false;
    }, 1600);
    soundUnMatch.play();

    oppunity--;
    document.querySelector(".memory__opportuvity").textContent = oppunity;
    if (oppunity == 0) {
      setTimeout(() => {
        memoryCards.forEach((card) => {
          card.classList.add("flip");
          card.removeEventListener("click", flipCard);
        });
      }, 2000);
      setTimeout(() => {
        document.querySelector(".memory__restart").style.transform = "scale(1)";
        memoryCards.style.transform = "scale(0)";
      }, 2500);
    }
  }
}

// 카드 섞기
function shuffledCard() {
  cardOne = cardTwo = "";
  disableDeck = false;
  matchedCard = 0;

  let arr = [
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
  ];
  let result = arr.sort(() => (Math.random() > 0.5 ? 1 : -1));

  memoryCards.forEach((card, index) => {
    card.classList.remove("flip");

    setTimeout(() => {
      card.classList.add("flip");
    }, 200 * index);

    setTimeout(() => {
      card.classList.remove("flip");
    }, 5000);

    let imgTag = card.querySelector(".back img");
    imgTag.src = `../assets/img/cardGame${arr[index]}.jpg`;
  });
}

// 카드 클릭
memoryCards.forEach((card) => {
  card.addEventListener("click", flipCard);
});

// 카드 게임 시작
memoryStart.addEventListener("click", () => {
  memoryIntro.style.display = "none";
  memoryCard.style.display = "block";
  shuffledCard();
  matchedCard = 0;
});

// 다 맞추고 다시 시작
memoryRestart2.addEventListener("click", () => {
  shuffledCard();
  oppunity = 3;
  document.querySelector(".memory__opportuvity").innerHTML = oppunity;
  matchedCard = 0;
  document.querySelector(".memory__score").innerHTML = matchedCard;
  memoryCards.forEach((card) => {
    card.classList.remove("flip");
    card.addEventListener("click", flipCard);
  });
  memoryRestart2.style.transform = "scale(0)";
});

// 실패하고 다시 시작
memoryRestart.addEventListener("click", () => {
  shuffledCard();
  oppunity = 3;
  document.querySelector(".memory__opportuvity").innerHTML = oppunity;
  matchedCard = 0;
  document.querySelector(".memory__score").innerHTML = matchedCard;
  memoryCards.forEach((card) => {
    card.classList.remove("flip");
    card.addEventListener("click", flipCard);
  });
  memoryRestart.style.transform = "scale(0)";
});
