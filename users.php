<? //missing <?php

public function updateUsers($users) //:return type?
{
	foreach ($users as $user) {
		try {
			if ($user['name'] && $user['login'] && $user['email'] && $user['password'] && strlen($user['name']) >= 10) 
				DB::table('users')->where('id', $user['id'])->update([  //you didnt check if 'id' exists, are you sure you can always use it? (idk if it is nullable or not)
					'name' => $user['name'],
					'login' => $user['login'],
					'email' => $user['email'],
					'password' => md5($user['password'])
				]); // additional brace for this ^^ block of code would be appreciated
		} catch (\Throwable $e) { //I would reccomend removing qualifiers and just import Throwable
			return Redirect::back()->withErrors(['error', ['We couldn\'t update user: ' . $e->getMessage()]]);
		}
	}
	return Redirect::back()->with(['success', 'All users updated.']); //add empty line for better look
}

public function storeUsers($users) //:return type?
{
    //remove this empty line
    foreach ($users as $user) {
        try {
			if ($user['name'] && $user['login'] && $user['email'] && $user['password'] && strlen($user['name']) >= 10) //fix indentation
				DB::table('users')->insert([
					'name' => $user['name'],
					'login' => $user['login'],
					'email' => $user['email'],
					'password' => md5($user['password'])
            ]); //additional brace for this if ^^ block of code would be appreciated
        } catch (\Throwable $e) { //I would reccomend removing qualifiers and just import Throwable
            return Redirect::back()->withErrors(['error', ['We couldn\'t store user: ' . $e->getMessage()]]);
        }
    }
    $this->sendEmail($users); //please add empty lines for better look
    return Redirect::back()->with(['success', 'All users created.']);
}

private function sendEmail($users) //:return type?
{
    foreach ($users as $user) {
        $message = 'Account has beed created. You can log in as <b>' . $user['login'] . '</b>'; //add empty line for better look
        if ($user['email']) {
            Mail::to($user['email'])
                ->cc('support@company.com')
                ->subject('New account created')
                ->queue($message);
        } //additional brace for this if ^^ block of code would be appreciated
    } 
    return true; //add empty line for better look
}
//this ending questionmark is unneccesary
?> 
