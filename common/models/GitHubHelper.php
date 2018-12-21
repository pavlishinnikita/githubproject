<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 21.12.2018
 * Time: 12:08
 */

namespace common\models;


class GitHubHelper
{
    const GITHUB_TOKEN = "7f318fddd62f933e1276cde5836046a301ee0814";
    const URL = "https://api.github.com/repositories";
    const CONTENT_TYPE = "application/json";
    const USER_AGENT = "Mozilla/5.0";
    const URL_SEARCH = "https://api.github.com/search/repositories";
    const URL_SEARCH_END = "&sort=stars&order=desc";
}