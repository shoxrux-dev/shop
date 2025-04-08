<?php
//$client = new Google_Client();
//$client->setApplicationName('PHP');
//$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
//$client->setAccessType('offline');
//try {
//    $client->setAuthConfig(__DIR__ . '/credentials.json');
//} catch (\Google\Exception $e) {}
//
//$service = new Google_Service_Sheets($client);
//$spreadsheetId = '1LnmYp1FKblhs_6eYxqJlgl5kLE95cl-j_qUcAX0dBzM';
//$range = 'xyz-qwerty';
//
//$params = [
//    'valueInputOption' => "RAW",
//];
//
//$insert = [
//    'insertDataOptions' => 'INSERT_ROWS'
//];
//
//$values = [
//    [
//        Emoji::Decode($userjon["firstname"]),
//        Emoji::Decode($userjon["lastname"]),
//        Emoji::Decode($userjon["region"]),
//        Emoji::Decode($userjon["address"]),
//        Emoji::Decode($userjon["orient"]),
//        Emoji::Decode($userjon["phone_number"]),
//        Emoji::Decode($userjon["phone_number_2"]),
//        Emoji::Decode($userjon["geo_location"]),
//        $username,
//    ],
//
//];
//
//$body = new Google_Service_Sheets_ValueRange([
//    'majorDimension' => 'ROWS',
//    'values' => $values,
//]);
//
//$response = $service->spreadsheets_values->get(spreadsheetId, $range);
//$old_values = $response->getValues();
//
//$result = $service->spreadsheets_values->update(spreadsheetId, "list!A" . (count($old_values) + 1) . ":I" . (count($old_values) + 1), $body, $params);
