<div class="site-index">
    <div class="bs-example">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>питання</th>
                <th>відповідь на питання</th>
                <th>правильно \  ні</th>
                <!--                <th>Кількість правильних відповідей</th>-->
                <!--                <th>Кількість неправильних відповідей</th>-->
            </tr>
            <?php
            foreach ($model as $test) {
                ?>

                <tr>
                    <td>     <?= $test->question ?>      </td>
                    <td> <?= $test->questions_answer ?></td>
                    <td> <?= $test->status ?></td>

                    <!--                                <td>--><?//= $test->correct_unswer?><!-- </td>-->
                    <!--                                <td>--><?//= $test->wrong_unswer?><!--</td>-->
                </tr>

                <?php
            }
            ?>

            </tbody>
        </table>
    </div>


</div>
