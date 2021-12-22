const quizData = [
    {
        question: "Wer köpft Voldemorts Schlange Nagini mit Gryffindors Schwert?",
        a: "Harry",
        b: "Neville",
        c: "Hermine",
        d: "Fred",
        correct: "b",
    },
    {
        question: "In welchem Jahr wurde Albus Dumbledore geboren?",
        a: "1703",
        b: "1913",
        c: "1881",
        d: "1932",
        correct: "c",
    },
    {
        question: "Wie lautet Dumbledores vollständiger Name?",
        a: "Albus Magnus Severus Dumbledore",
        b: "Albus Godric Ethelbert Raedwulf Dumbledore",
        c: "Albus Brian Christopher Damian Earl Dumbledore",
        d: "Albus Percival Wulfric Brian Dumbledore",
        correct: "d",
    },
    {
        question: "Wie heißt der Sohn von Draco Malfoy?",
        a: "Scorpius",
        b: "Lucius",
        c: "Harry",
        d: "Rowan",
        correct: "a",
    },
    {
        question: "Wie heißt der Goldfisch von Horace Slughorn?",
        a: "Francis",
        b: "Lilly",
        c: "Nebulus",
        d: "Nora",
        correct: "a",
    },
    {
        question: "Und welchem Haus gehört Horace Slughorn an?",
        a: "Gryffindor",
        b: "Ravenclaw",
        c: "Hufflepuff",
        d: "Slytherin",
        correct: "d",
    },
    {
        question: "Wie lautet das Passwort für den Gryffindor Gemeinschaftsraum im dritten Schuljahr?",
        a: "Schweineschnauze",
        b: "Fortuna Major",
        c: "Caput Draconis",
        d: "Mimbulus Mimbeltonia",
        correct: "b",
    },
    {
        question: "Und kannst du dich auch an das erste bekannte Passwort für Dumbledores Büro erinnern?",
        a: "Mimbulus Mimbeltonia",
        b: "Zischende Zauberdrops",
        c: "Dumbledore",
        d: "Scherbert Zitrone",
        correct: "b",
    },
    {
        question: "Wieso wurde Rubeus Hagrid in seiner Jugend der Schule verwiesen?",
        a: "Heimliches Züchten von Werwölfen",
        b: "Angriff auf den Schulleiter",
        c: "Öffnen der Kammer des Schreckens",
        d: "Mord an einem Schüler",
        correct: "c",
    },
    {
        question: "Welche Animagusgestalt kann Rita Kimmkorn annehmen?",
        a: "Adler",
        b: "Käfer",
        c: "Krähe",
        d: "Frosch",
        correct: "b",
    },
    {
        question: "Die Weasley-Zwillinge wissen im vierten Teil, wie man in die Küchen von Hogwarts kommt. Wie gelangt man dort hin?",
        a: "Eine Birne auf einem Obstschalenporträt kitzeln",
        b: "Dem Porträt des Ritters Sir Cadogan zuprosten",
        c: "Mit dem Passwort Krönungsmahl",
        d: "Über einen Geheimgang im Eberkopf",
        correct: "a",
    },
    {
        question: "Wer gründete das Zaubererdorf Hogsmeade?",
        a: "Aberforth Dumbledore",
        b: "Hengis von Woodcroft",
        c: "Gellert Grindelwald",
        d: "Kobolde",
        correct: "b",
    },
    {
        question: "Wodurch kann ein Quidditchspiel außer dem Fang des Schnatzes beendet werden?",
        a: "Wenn mindestens drei Spieler verschwunden sind",
        b: "Der Fang des Schnatzes ist die einzige Möglichkeit",
        c: "Wenn beide Kapitäne sich einig sind",
        d: "Wenn ein Spieler vom Besen fällt",
        correct: "c",
    },
    {
        question: "Wovon soll man laut dem Türschild der Lovegoods die Hände lassen?",
        a: "Schlickschlupfe",
        b: "Lenkpflaumen",
        c: "Minimuffs",
        d: "Schrumpfhörnige Schnarchkackler",
        correct: "b",
    },
    {
        question: "Durch wessen Imperius-Fluch wurde Pius Thicknese gesteuert?",
        a: "Yaxley",
        b: "Dolohow",
        c: "Die Carrows",
        d: "Bellatrix Lestrange",
        correct: "a",
    },
    {
        question: "Von wem wurden die Harry Potter Bande aus dem Englischen ins Deutsche übersetzt?",
        a: "Fritz Klaus",
        b: "Klaus Fritz",
        c: "Werner Fritz",
        d: "Fritz Werner",
        correct: "b",
    },
    {
        question: "Wer oder was ist Grindeloh?",
        a: "Hagrids Bruder",
        b: "Das Tagebuch Gellert Grindelwalds",
        c: "Eine Gnom-Art aus Wales",
        d: "Ein Wasserdämon",
        correct: "d",
    },
    {
        question: "Wer schrieb das Lehrbuch der Zaubersprüche?",
        a: "Miranda Habicht",
        b: "Gilderoy Lockhart",
        c: "Bathilda Bagshot",
        d: "Phyllida Spore",
        correct: "a",
    },
    {
        question: "Welche Zutat ist NICHT Teil des Rezepts für den Vielsaft-Trank?",
        a: "Florfliegen",
        b: "Spulenwurzel",
        c: "Baumschlangenhaut",
        d: "Flussgras",
        correct: "b",
    },
    {
        question: "Wie nennt sich das Automodell, mit dem Harry und Ron nach Hogwarts fliegen und am Ende in der Peitschenden Weide landen?",
        a: "Ford Anglia 105E",
        b: "Ford Mustang V8 Coupe",
        c: "Opel Kadett D",
        d: "Morris Minor Traveller",
        correct: "a",
    },
    {
        question: "Ab welchem Alter dürfen Hexen und Zauberer apparieren?",
        a: "Mit 15",
        b: "Mit 17",
        c: "Mit 16",
        d: "Mit 18",
        correct: "b",
    },
];

const quiz = document.getElementById("quiz");
const answerEls = document.querySelectorAll(".answer");
const questionEl = document.getElementById("question");
const a_text = document.getElementById("a_text");
const b_text = document.getElementById("b_text");
const c_text = document.getElementById("c_text");
const d_text = document.getElementById("d_text");
const submitBtn = document.getElementById("submit");
let counterElement = document.getElementById("counterNumber");

let currentCounter = 1;
let currentQuiz = 0;
let score = 0;


currentCounter = counterElement.innerText;
console.log(counterElement++);


loadQuiz();

function loadQuiz() {
    deselectAnswers();

    const currentQuizData = quizData[currentQuiz];

    questionEl.innerText = currentQuizData.question;
    a_text.innerText = currentQuizData.a;
    b_text.innerText = currentQuizData.b;
    c_text.innerText = currentQuizData.c;
    d_text.innerText = currentQuizData.d;

}

function getSelected() {
    let answer = undefined;

    answerEls.forEach((answerEl) => {
        if (answerEl.checked) {
            answer = answerEl.id;
        }
    });

    return answer;
}

function deselectAnswers() {
    answerEls.forEach((answerEl) => {
        answerEl.checked = false;
    });
}

submitBtn.addEventListener("click", () => {
    // check to see the answer
    const answer = getSelected();

    if (answer) {
        if (answer === quizData[currentQuiz].correct) {
            score++;

        }

        currentQuiz++;
        if (currentQuiz < quizData.length) {
            loadQuiz();
        } else {
            quiz.innerHTML = `
                <h2>You answered correctly at ${score}/${quizData.length} questions.</h2>
                
                <button onclick="location.reload()">Reload</button>
            `;
        }
    }
});