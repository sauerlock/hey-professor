<?php

use PHPUnit\Event\Code\Test;

test('that true is true', function () {
    expect(true)->toBeTrue();
});