<?php

namespace App\Controllers;

use App\Database\Query;
use App\Api\ApiBase;

class ApiController extends ApiBase
{
	public $apiName = 'forms';

	/**
	 * Method GET
	 * List all forms
	 * http://domain/forms
	 * @return string
	 */
	public function index()
	{
		$query = new Query;
		$forms = $query->getList("SELECT * FROM forms");
		if ($forms) {
			return $this->response($forms, 200);
		}
		return $this->response('Data not found', 404);
	}

	/**
	 * Method POST
	 * Creating a new entry
	 * http://domain/api/forms
	 * post parameters title, content
	 * @return string
	 */
	public function create()
	{

		$title = $this->requestParams['title'] ?? '';
		$content = $this->requestParams['content'] ?? '';

		if ($title && $content) {
			$query = new Query();
			$query->execute(
				"INSERT INTO forms (title, content) VALUES (?, ?)",
				[$title, $content]
			);

			if ($query) {
				return $this->response('Data saved.', 200);
			}

		}

		return $this->response("Saving error", 500);
	}

	/**
	 * Method PUT
	 * Update individual record (by its id)
	 * http://domain/api/forms/update
	 * post parameters title, content
	 * @return string
	 */
	public function update()
	{
		$id = $this->requestParams['id'] ?? null;
		$title = $this->requestParams['title'] ?? '';
		$content = $this->requestParams['content'] ?? '';

		$query = new Query;

		$form = $query->getRow(
			"SELECT * FROM forms WHERE id = ?",
			[$id]
		);

		if (!$id || !$form) {
			return $this->response("User with id=$id not found", 404);
		}


		$queryStr = "UPDATE `forms` SET `title` = ?, `content` = ? WHERE `id` = ?";

		$query->execute($queryStr, [$title, $content, $id]);

		return $this->response('Data updated.', 200);
	}


	/**
	 * Method DELETE
	 * Delete a single entry (by its id)
	 * http://domain/api/forms/delete
	 * post parameters id
	 * @return string
	 */
	public function delete()
	{
		$id = $this->requestParams['id'] ?? null;

		$query = new Query;

		$query->execute("DELETE FROM forms WHERE id = ?", [$id]);

		return $this->response('Data deleted.', 200);
	}
}
