<?php

/*
 * (c) Ivan Hanak <packagist@ivanhanak.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace hanakivan;

class DateFormats {

    // => 23. 12. 2020 19:00
    const DATETIME_FORMAT = "j. n. Y G:i";

    // => 12/23/20 7:00pm
    const DATETIME_FORMAT_US = "m/d/y g:ia";

    // => 19:00
    const TIME_FORMAT = "G:i";

    // => 7:00pm
    const TIME_FORMAT_US = "g:ia";

    // => 23. 12. 2020
    const DATE_FORMAT = "j. n. Y";

    // => 12/23/20
    const DATE_FORMAT_US = "m/d/y";

    // => January
    const MONTH_FULL_NAME = "F";

    // => 1 (as a january)
    const MONTH_NUMBER = "n";

    // => 2020
    const FULL_YEAR = "Y";

    // => day number without leading zero, e.g. 1, 4, 10, 31...
    const DAY_NUMBER = "j";
}
