<?php
$filename = 'Quiz.txt';
$questions = [];

if (file_exists($filename)) {
    $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $current_question = [
        'text' => '',
        'options' => [],
        'answer' => ''
    ];

    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;
        if (strpos($line, 'ANSWER:') === 0) {
            $current_question['answer'] = trim(str_replace('ANSWER:', '', $line));
            $questions[] = $current_question;
            $current_question = [
                'text' => '',
                'options' => [],
                'answer' => ''
            ];
        } 
        elseif (preg_match('/^[A-D]\./', $line)) {
            $current_question['options'][] = $line;
        } 
        else {
            $current_question['text'] .= $line . " ";
        }
    }
} else {
    echo "Không tìm thấy file Quiz.txt";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 02: Trắc nghiệm Android</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0f2f5; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; color: #007bff; margin-bottom: 30px; }
        .quiz-item { margin-bottom: 25px; border-bottom: 1px dashed #ccc; padding-bottom: 20px; }
        .question-title { font-weight: bold; font-size: 1.1em; color: #333; margin-bottom: 10px; }
        .options label { display: block; margin-bottom: 8px; cursor: pointer; padding: 5px; border-radius: 4px; transition: background 0.2s; }
        .options label:hover { background-color: #e9ecef; }
        .correct-answer { color: #28a745; font-weight: bold; margin-top: 10px; display: none; } /* Mặc định ẩn đáp án */
        
        /* Nút xem đáp án */
        .btn-check { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; display: block; margin: 20px auto; font-size: 16px; }
        .btn-check:hover { background-color: #218838; }
    </style>
</head>
<body>

<div class="container">
    <h1>Bài Thi Trắc Nghiệm Android</h1>

    <form id="quizForm">
        <?php foreach ($questions as $index => $q): ?>
            <div class="quiz-item">
                <div class="question-title">
                    Câu <?php echo $index + 1; ?>: <?php echo htmlspecialchars($q['text']); ?>
                </div>
                
                <div class="options">
                    <?php foreach ($q['options'] as $opt): ?>
                        <label>
                            <input type="radio" name="q_<?php echo $index; ?>" value="<?php echo substr($opt, 0, 1); ?>"> 
                            <?php echo htmlspecialchars($opt); ?>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="correct-answer" id="ans_<?php echo $index; ?>">
                    ✅ Đáp án đúng: <?php echo $q['answer']; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <button type="button" class="btn-check" onclick="showAnswers()">Nộp bài & Xem kết quả</button>
    </form>
</div>

<script>
    function showAnswers() {
        var answers = document.querySelectorAll('.correct-answer');
        answers.forEach(function(div) {
            div.style.display = 'block';
        });
        alert("Đã hiển thị đáp án!");
    }
</script>

</body>
</html>