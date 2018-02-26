
<h1> Результати  проходження <?php echo $_POST['Test']['name_tests']; ?>  тесту </h1>

<div class="site-index">

    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>відповідь на питання</th>
                <th>Правильно \ ні</th>
                <th>питання</th>
            </tr>
            <?php
            if (isset($_POST['Question']) && $_POST['QuestionOption']):
                foreach ($_POST['QuestionOption'] as $questionOption):
                    foreach ($questionOption as $option)://
                        if ($option['option_text']) {
                            ?>
                            <tr>
                                <td> <?= $option['option_text'] ?></td>
                                <td> <?= $option['correct_option'] ?></td>

                            <?php
                            foreach ($_POST['Question'] as  $qestion):
                                if ($qestion['id'] == $option['qestion_id']) {
                                    ?>
                                    <td> <?= $qestion['text_qestion'] ?></td>
                               <?php
                                }
                            endforeach; ?>
                      <tr>
                                <?php
                        }
                    endforeach;
                endforeach;
            endif;
                ?>
            </tbody>
        </table>
    </div>

</div>
