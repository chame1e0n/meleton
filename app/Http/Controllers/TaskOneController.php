<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskOneController extends Controller
{
    public function index()
    {
        $connection = DB::connection();

        $items = $connection->select('
SELECT `users`.`id` AS `ID`, CONCAT(`users`.`first_name`, " ", `users`.`last_name`) AS `Name`, `books`.`author` AS `Author`, GROUP_CONCAT(`books`.`name` SEPARATOR ", ") AS `Books`
FROM `users`
INNER JOIN `user_books` ON (`users`.`id` = `user_books`.`user_id`)
INNER JOIN `books` ON (`user_books`.`book_id` = `books`.`id`)
WHERE
	`users`.`id` IN (
		SELECT `users`.`id`
		FROM `users`
		INNER JOIN `user_books` ON (`users`.`id` = `user_books`.`user_id`)
		GROUP BY `user_books`.`user_id`
		HAVING COUNT(*) = 2) AND
	`users`.`id` IN (
		SELECT `users`.`id`
		FROM `users`
		INNER JOIN `user_books` ON (`users`.`id` = `user_books`.`user_id`)
        INNER JOIN `books` ON (`user_books`.`book_id` = `books`.`id`)
		GROUP BY `user_books`.`user_id`, `books`.`author`
		HAVING COUNT(*) = 2
	)
GROUP BY `users`.`id`
        ');

        return view('items', compact('items'));
    }
}
