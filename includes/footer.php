<footer>
    <p>&copy;
    <?php
    $startYear = 2019;
    $thisYear = date('Y');
    if ($startYear == $thisYear) {
        echo $startYear;
    } else {
        echo "{$startYear}&ndash;{$thisYear}";
    }
    ?>
    Qing He, Created by Qing's Machine</p>
</footer>
 