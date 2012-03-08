<?php


/**
 * Base class that represents a row from the 'users' table.
 *
 * 
 *
 * @package    propel.generator.database.om
 */
abstract class BasecTableUsers extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'cTableUsersPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        cTableUsersPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the id field.
	 * @var        string
	 */
	protected $id;

	/**
	 * The value for the user_name field.
	 * @var        string
	 */
	protected $user_name;

	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;

	/**
	 * The value for the first_name field.
	 * @var        string
	 */
	protected $first_name;

	/**
	 * The value for the middle_name field.
	 * @var        string
	 */
	protected $middle_name;

	/**
	 * The value for the last_name field.
	 * @var        string
	 */
	protected $last_name;

	/**
	 * The value for the personal_title field.
	 * @var        string
	 */
	protected $personal_title;

	/**
	 * The value for the professional_title field.
	 * @var        string
	 */
	protected $professional_title;

	/**
	 * The value for the phone_num_1 field.
	 * @var        string
	 */
	protected $phone_num_1;

	/**
	 * The value for the phone_num_2 field.
	 * @var        string
	 */
	protected $phone_num_2;

	/**
	 * The value for the email1 field.
	 * @var        string
	 */
	protected $email1;

	/**
	 * The value for the email2 field.
	 * @var        string
	 */
	protected $email2;

	/**
	 * The value for the assigned_org field.
	 * @var        string
	 */
	protected $assigned_org;

	/**
	 * The value for the org field.
	 * @var        string
	 */
	protected $org;

	/**
	 * The value for the company field.
	 * @var        string
	 */
	protected $company;

	/**
	 * The value for the affiliation field.
	 * @var        string
	 */
	protected $affiliation;

	/**
	 * The value for the type field.
	 * @var        string
	 */
	protected $type;

	/**
	 * The value for the location field.
	 * @var        string
	 */
	protected $location;

	/**
	 * The value for the suite field.
	 * @var        string
	 */
	protected $suite;

	/**
	 * The value for the last_login field.
	 * @var        string
	 */
	protected $last_login;

	/**
	 * The value for the last_updated field.
	 * @var        string
	 */
	protected $last_updated;

	/**
	 * The value for the account_creation field.
	 * @var        string
	 */
	protected $account_creation;

	/**
	 * The value for the comment field.
	 * @var        resource
	 */
	protected $comment;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [user_name] column value.
	 * 
	 * @return     string
	 */
	public function getuserName()
	{
		return $this->user_name;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Get the [first_name] column value.
	 * 
	 * @return     string
	 */
	public function getfirstName()
	{
		return $this->first_name;
	}

	/**
	 * Get the [middle_name] column value.
	 * 
	 * @return     string
	 */
	public function getmiddleName()
	{
		return $this->middle_name;
	}

	/**
	 * Get the [last_name] column value.
	 * 
	 * @return     string
	 */
	public function getlastName()
	{
		return $this->last_name;
	}

	/**
	 * Get the [personal_title] column value.
	 * 
	 * @return     string
	 */
	public function getpersonalTitle()
	{
		return $this->personal_title;
	}

	/**
	 * Get the [professional_title] column value.
	 * 
	 * @return     string
	 */
	public function getprofessionalTitle()
	{
		return $this->professional_title;
	}

	/**
	 * Get the [phone_num_1] column value.
	 * 
	 * @return     string
	 */
	public function getphoneNum1()
	{
		return $this->phone_num_1;
	}

	/**
	 * Get the [phone_num_2] column value.
	 * 
	 * @return     string
	 */
	public function getphoneNum2()
	{
		return $this->phone_num_2;
	}

	/**
	 * Get the [email1] column value.
	 * 
	 * @return     string
	 */
	public function getEmail1()
	{
		return $this->email1;
	}

	/**
	 * Get the [email2] column value.
	 * 
	 * @return     string
	 */
	public function getEmail2()
	{
		return $this->email2;
	}

	/**
	 * Get the [assigned_org] column value.
	 * 
	 * @return     string
	 */
	public function getassignedOrg()
	{
		return $this->assigned_org;
	}

	/**
	 * Get the [org] column value.
	 * 
	 * @return     string
	 */
	public function getOrg()
	{
		return $this->org;
	}

	/**
	 * Get the [company] column value.
	 * 
	 * @return     string
	 */
	public function getCompany()
	{
		return $this->company;
	}

	/**
	 * Get the [affiliation] column value.
	 * 
	 * @return     string
	 */
	public function getAffiliation()
	{
		return $this->affiliation;
	}

	/**
	 * Get the [type] column value.
	 * 
	 * @return     string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Get the [location] column value.
	 * 
	 * @return     string
	 */
	public function getLocation()
	{
		return $this->location;
	}

	/**
	 * Get the [suite] column value.
	 * 
	 * @return     string
	 */
	public function getSuite()
	{
		return $this->suite;
	}

	/**
	 * Get the [optionally formatted] temporal [last_login] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getlastLogin($format = 'Y-m-d H:i:s')
	{
		if ($this->last_login === null) {
			return null;
		}


		if ($this->last_login === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->last_login);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_login, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [last_updated] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getlastUpdated($format = 'Y-m-d H:i:s')
	{
		if ($this->last_updated === null) {
			return null;
		}


		if ($this->last_updated === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->last_updated);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_updated, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [account_creation] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getaccountCreation($format = 'Y-m-d H:i:s')
	{
		if ($this->account_creation === null) {
			return null;
		}


		if ($this->account_creation === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->account_creation);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->account_creation, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [comment] column value.
	 * 
	 * @return     resource
	 */
	public function getComment()
	{
		return $this->comment;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = cTableUsersPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [user_name] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setuserName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->user_name !== $v) {
			$this->user_name = $v;
			$this->modifiedColumns[] = cTableUsersPeer::USER_NAME;
		}

		return $this;
	} // setuserName()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setPassword($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = cTableUsersPeer::PASSWORD;
		}

		return $this;
	} // setPassword()

	/**
	 * Set the value of [first_name] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setfirstName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = cTableUsersPeer::FIRST_NAME;
		}

		return $this;
	} // setfirstName()

	/**
	 * Set the value of [middle_name] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setmiddleName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->middle_name !== $v) {
			$this->middle_name = $v;
			$this->modifiedColumns[] = cTableUsersPeer::MIDDLE_NAME;
		}

		return $this;
	} // setmiddleName()

	/**
	 * Set the value of [last_name] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setlastName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = cTableUsersPeer::LAST_NAME;
		}

		return $this;
	} // setlastName()

	/**
	 * Set the value of [personal_title] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setpersonalTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->personal_title !== $v) {
			$this->personal_title = $v;
			$this->modifiedColumns[] = cTableUsersPeer::PERSONAL_TITLE;
		}

		return $this;
	} // setpersonalTitle()

	/**
	 * Set the value of [professional_title] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setprofessionalTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->professional_title !== $v) {
			$this->professional_title = $v;
			$this->modifiedColumns[] = cTableUsersPeer::PROFESSIONAL_TITLE;
		}

		return $this;
	} // setprofessionalTitle()

	/**
	 * Set the value of [phone_num_1] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setphoneNum1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->phone_num_1 !== $v) {
			$this->phone_num_1 = $v;
			$this->modifiedColumns[] = cTableUsersPeer::PHONE_NUM_1;
		}

		return $this;
	} // setphoneNum1()

	/**
	 * Set the value of [phone_num_2] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setphoneNum2($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->phone_num_2 !== $v) {
			$this->phone_num_2 = $v;
			$this->modifiedColumns[] = cTableUsersPeer::PHONE_NUM_2;
		}

		return $this;
	} // setphoneNum2()

	/**
	 * Set the value of [email1] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setEmail1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email1 !== $v) {
			$this->email1 = $v;
			$this->modifiedColumns[] = cTableUsersPeer::EMAIL1;
		}

		return $this;
	} // setEmail1()

	/**
	 * Set the value of [email2] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setEmail2($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->email2 !== $v) {
			$this->email2 = $v;
			$this->modifiedColumns[] = cTableUsersPeer::EMAIL2;
		}

		return $this;
	} // setEmail2()

	/**
	 * Set the value of [assigned_org] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setassignedOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->assigned_org !== $v) {
			$this->assigned_org = $v;
			$this->modifiedColumns[] = cTableUsersPeer::ASSIGNED_ORG;
		}

		return $this;
	} // setassignedOrg()

	/**
	 * Set the value of [org] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->org !== $v) {
			$this->org = $v;
			$this->modifiedColumns[] = cTableUsersPeer::ORG;
		}

		return $this;
	} // setOrg()

	/**
	 * Set the value of [company] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setCompany($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->company !== $v) {
			$this->company = $v;
			$this->modifiedColumns[] = cTableUsersPeer::COMPANY;
		}

		return $this;
	} // setCompany()

	/**
	 * Set the value of [affiliation] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setAffiliation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->affiliation !== $v) {
			$this->affiliation = $v;
			$this->modifiedColumns[] = cTableUsersPeer::AFFILIATION;
		}

		return $this;
	} // setAffiliation()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = cTableUsersPeer::TYPE;
		}

		return $this;
	} // setType()

	/**
	 * Set the value of [location] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setLocation($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->location !== $v) {
			$this->location = $v;
			$this->modifiedColumns[] = cTableUsersPeer::LOCATION;
		}

		return $this;
	} // setLocation()

	/**
	 * Set the value of [suite] column.
	 * 
	 * @param      string $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setSuite($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->suite !== $v) {
			$this->suite = $v;
			$this->modifiedColumns[] = cTableUsersPeer::SUITE;
		}

		return $this;
	} // setSuite()

	/**
	 * Sets the value of [last_login] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setlastLogin($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->last_login !== null || $dt !== null) {
			$currentDateAsString = ($this->last_login !== null && $tmpDt = new DateTime($this->last_login)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->last_login = $newDateAsString;
				$this->modifiedColumns[] = cTableUsersPeer::LAST_LOGIN;
			}
		} // if either are not null

		return $this;
	} // setlastLogin()

	/**
	 * Sets the value of [last_updated] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setlastUpdated($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->last_updated !== null || $dt !== null) {
			$currentDateAsString = ($this->last_updated !== null && $tmpDt = new DateTime($this->last_updated)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->last_updated = $newDateAsString;
				$this->modifiedColumns[] = cTableUsersPeer::LAST_UPDATED;
			}
		} // if either are not null

		return $this;
	} // setlastUpdated()

	/**
	 * Sets the value of [account_creation] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setaccountCreation($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->account_creation !== null || $dt !== null) {
			$currentDateAsString = ($this->account_creation !== null && $tmpDt = new DateTime($this->account_creation)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->account_creation = $newDateAsString;
				$this->modifiedColumns[] = cTableUsersPeer::ACCOUNT_CREATION;
			}
		} // if either are not null

		return $this;
	} // setaccountCreation()

	/**
	 * Set the value of [comment] column.
	 * 
	 * @param      resource $v new value
	 * @return     cTableUsers The current object (for fluent API support)
	 */
	public function setComment($v)
	{
		// Because BLOB columns are streams in PDO we have to assume that they are
		// always modified when a new value is passed in.  For example, the contents
		// of the stream itself may have changed externally.
		if (!is_resource($v) && $v !== null) {
			$this->comment = fopen('php://memory', 'r+');
			fwrite($this->comment, $v);
			rewind($this->comment);
		} else { // it's already a stream
			$this->comment = $v;
		}
		$this->modifiedColumns[] = cTableUsersPeer::COMMENT;

		return $this;
	} // setComment()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->user_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->password = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->first_name = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->middle_name = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->last_name = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->personal_title = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->professional_title = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->phone_num_1 = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->phone_num_2 = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->email1 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->email2 = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->assigned_org = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->org = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->company = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->affiliation = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->type = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->location = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->suite = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->last_login = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->last_updated = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->account_creation = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			if ($row[$startcol + 22] !== null) {
				$this->comment = fopen('php://memory', 'r+');
				fwrite($this->comment, $row[$startcol + 22]);
				rewind($this->comment);
			} else {
				$this->comment = null;
			}
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 23; // 23 = cTableUsersPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating cTableUsers object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = cTableUsersPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = cTableUsersQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(cTableUsersPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				cTableUsersPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				// Rewind the comment LOB column, since PDO does not rewind after inserting value.
				if ($this->comment !== null && is_resource($this->comment)) {
					rewind($this->comment);
				}

				$this->resetModified();
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;


		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(cTableUsersPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(cTableUsersPeer::USER_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`USER_NAME`';
		}
		if ($this->isColumnModified(cTableUsersPeer::PASSWORD)) {
			$modifiedColumns[':p' . $index++]  = '`PASSWORD`';
		}
		if ($this->isColumnModified(cTableUsersPeer::FIRST_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`FIRST_NAME`';
		}
		if ($this->isColumnModified(cTableUsersPeer::MIDDLE_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`MIDDLE_NAME`';
		}
		if ($this->isColumnModified(cTableUsersPeer::LAST_NAME)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_NAME`';
		}
		if ($this->isColumnModified(cTableUsersPeer::PERSONAL_TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`PERSONAL_TITLE`';
		}
		if ($this->isColumnModified(cTableUsersPeer::PROFESSIONAL_TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`PROFESSIONAL_TITLE`';
		}
		if ($this->isColumnModified(cTableUsersPeer::PHONE_NUM_1)) {
			$modifiedColumns[':p' . $index++]  = '`PHONE_NUM_1`';
		}
		if ($this->isColumnModified(cTableUsersPeer::PHONE_NUM_2)) {
			$modifiedColumns[':p' . $index++]  = '`PHONE_NUM_2`';
		}
		if ($this->isColumnModified(cTableUsersPeer::EMAIL1)) {
			$modifiedColumns[':p' . $index++]  = '`EMAIL1`';
		}
		if ($this->isColumnModified(cTableUsersPeer::EMAIL2)) {
			$modifiedColumns[':p' . $index++]  = '`EMAIL2`';
		}
		if ($this->isColumnModified(cTableUsersPeer::ASSIGNED_ORG)) {
			$modifiedColumns[':p' . $index++]  = '`ASSIGNED_ORG`';
		}
		if ($this->isColumnModified(cTableUsersPeer::ORG)) {
			$modifiedColumns[':p' . $index++]  = '`ORG`';
		}
		if ($this->isColumnModified(cTableUsersPeer::COMPANY)) {
			$modifiedColumns[':p' . $index++]  = '`COMPANY`';
		}
		if ($this->isColumnModified(cTableUsersPeer::AFFILIATION)) {
			$modifiedColumns[':p' . $index++]  = '`AFFILIATION`';
		}
		if ($this->isColumnModified(cTableUsersPeer::TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`TYPE`';
		}
		if ($this->isColumnModified(cTableUsersPeer::LOCATION)) {
			$modifiedColumns[':p' . $index++]  = '`LOCATION`';
		}
		if ($this->isColumnModified(cTableUsersPeer::SUITE)) {
			$modifiedColumns[':p' . $index++]  = '`SUITE`';
		}
		if ($this->isColumnModified(cTableUsersPeer::LAST_LOGIN)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_LOGIN`';
		}
		if ($this->isColumnModified(cTableUsersPeer::LAST_UPDATED)) {
			$modifiedColumns[':p' . $index++]  = '`LAST_UPDATED`';
		}
		if ($this->isColumnModified(cTableUsersPeer::ACCOUNT_CREATION)) {
			$modifiedColumns[':p' . $index++]  = '`ACCOUNT_CREATION`';
		}
		if ($this->isColumnModified(cTableUsersPeer::COMMENT)) {
			$modifiedColumns[':p' . $index++]  = '`COMMENT`';
		}

		$sql = sprintf(
			'INSERT INTO `users` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_STR);
						break;
					case '`USER_NAME`':
						$stmt->bindValue($identifier, $this->user_name, PDO::PARAM_STR);
						break;
					case '`PASSWORD`':
						$stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
						break;
					case '`FIRST_NAME`':
						$stmt->bindValue($identifier, $this->first_name, PDO::PARAM_STR);
						break;
					case '`MIDDLE_NAME`':
						$stmt->bindValue($identifier, $this->middle_name, PDO::PARAM_STR);
						break;
					case '`LAST_NAME`':
						$stmt->bindValue($identifier, $this->last_name, PDO::PARAM_STR);
						break;
					case '`PERSONAL_TITLE`':
						$stmt->bindValue($identifier, $this->personal_title, PDO::PARAM_STR);
						break;
					case '`PROFESSIONAL_TITLE`':
						$stmt->bindValue($identifier, $this->professional_title, PDO::PARAM_STR);
						break;
					case '`PHONE_NUM_1`':
						$stmt->bindValue($identifier, $this->phone_num_1, PDO::PARAM_STR);
						break;
					case '`PHONE_NUM_2`':
						$stmt->bindValue($identifier, $this->phone_num_2, PDO::PARAM_STR);
						break;
					case '`EMAIL1`':
						$stmt->bindValue($identifier, $this->email1, PDO::PARAM_STR);
						break;
					case '`EMAIL2`':
						$stmt->bindValue($identifier, $this->email2, PDO::PARAM_STR);
						break;
					case '`ASSIGNED_ORG`':
						$stmt->bindValue($identifier, $this->assigned_org, PDO::PARAM_STR);
						break;
					case '`ORG`':
						$stmt->bindValue($identifier, $this->org, PDO::PARAM_STR);
						break;
					case '`COMPANY`':
						$stmt->bindValue($identifier, $this->company, PDO::PARAM_STR);
						break;
					case '`AFFILIATION`':
						$stmt->bindValue($identifier, $this->affiliation, PDO::PARAM_STR);
						break;
					case '`TYPE`':
						$stmt->bindValue($identifier, $this->type, PDO::PARAM_STR);
						break;
					case '`LOCATION`':
						$stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
						break;
					case '`SUITE`':
						$stmt->bindValue($identifier, $this->suite, PDO::PARAM_STR);
						break;
					case '`LAST_LOGIN`':
						$stmt->bindValue($identifier, $this->last_login, PDO::PARAM_STR);
						break;
					case '`LAST_UPDATED`':
						$stmt->bindValue($identifier, $this->last_updated, PDO::PARAM_STR);
						break;
					case '`ACCOUNT_CREATION`':
						$stmt->bindValue($identifier, $this->account_creation, PDO::PARAM_STR);
						break;
					case '`COMMENT`':
						if (is_resource($this->comment)) {
							rewind($this->comment);
						}
						$stmt->bindValue($identifier, $this->comment, PDO::PARAM_LOB);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = cTableUsersPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = cTableUsersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getuserName();
				break;
			case 2:
				return $this->getPassword();
				break;
			case 3:
				return $this->getfirstName();
				break;
			case 4:
				return $this->getmiddleName();
				break;
			case 5:
				return $this->getlastName();
				break;
			case 6:
				return $this->getpersonalTitle();
				break;
			case 7:
				return $this->getprofessionalTitle();
				break;
			case 8:
				return $this->getphoneNum1();
				break;
			case 9:
				return $this->getphoneNum2();
				break;
			case 10:
				return $this->getEmail1();
				break;
			case 11:
				return $this->getEmail2();
				break;
			case 12:
				return $this->getassignedOrg();
				break;
			case 13:
				return $this->getOrg();
				break;
			case 14:
				return $this->getCompany();
				break;
			case 15:
				return $this->getAffiliation();
				break;
			case 16:
				return $this->getType();
				break;
			case 17:
				return $this->getLocation();
				break;
			case 18:
				return $this->getSuite();
				break;
			case 19:
				return $this->getlastLogin();
				break;
			case 20:
				return $this->getlastUpdated();
				break;
			case 21:
				return $this->getaccountCreation();
				break;
			case 22:
				return $this->getComment();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
	{
		if (isset($alreadyDumpedObjects['cTableUsers'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['cTableUsers'][$this->getPrimaryKey()] = true;
		$keys = cTableUsersPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getuserName(),
			$keys[2] => $this->getPassword(),
			$keys[3] => $this->getfirstName(),
			$keys[4] => $this->getmiddleName(),
			$keys[5] => $this->getlastName(),
			$keys[6] => $this->getpersonalTitle(),
			$keys[7] => $this->getprofessionalTitle(),
			$keys[8] => $this->getphoneNum1(),
			$keys[9] => $this->getphoneNum2(),
			$keys[10] => $this->getEmail1(),
			$keys[11] => $this->getEmail2(),
			$keys[12] => $this->getassignedOrg(),
			$keys[13] => $this->getOrg(),
			$keys[14] => $this->getCompany(),
			$keys[15] => $this->getAffiliation(),
			$keys[16] => $this->getType(),
			$keys[17] => $this->getLocation(),
			$keys[18] => $this->getSuite(),
			$keys[19] => $this->getlastLogin(),
			$keys[20] => $this->getlastUpdated(),
			$keys[21] => $this->getaccountCreation(),
			$keys[22] => $this->getComment(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = cTableUsersPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setuserName($value);
				break;
			case 2:
				$this->setPassword($value);
				break;
			case 3:
				$this->setfirstName($value);
				break;
			case 4:
				$this->setmiddleName($value);
				break;
			case 5:
				$this->setlastName($value);
				break;
			case 6:
				$this->setpersonalTitle($value);
				break;
			case 7:
				$this->setprofessionalTitle($value);
				break;
			case 8:
				$this->setphoneNum1($value);
				break;
			case 9:
				$this->setphoneNum2($value);
				break;
			case 10:
				$this->setEmail1($value);
				break;
			case 11:
				$this->setEmail2($value);
				break;
			case 12:
				$this->setassignedOrg($value);
				break;
			case 13:
				$this->setOrg($value);
				break;
			case 14:
				$this->setCompany($value);
				break;
			case 15:
				$this->setAffiliation($value);
				break;
			case 16:
				$this->setType($value);
				break;
			case 17:
				$this->setLocation($value);
				break;
			case 18:
				$this->setSuite($value);
				break;
			case 19:
				$this->setlastLogin($value);
				break;
			case 20:
				$this->setlastUpdated($value);
				break;
			case 21:
				$this->setaccountCreation($value);
				break;
			case 22:
				$this->setComment($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = cTableUsersPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setuserName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPassword($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setfirstName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setmiddleName($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setlastName($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setpersonalTitle($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setprofessionalTitle($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setphoneNum1($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setphoneNum2($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setEmail1($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setEmail2($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setassignedOrg($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setOrg($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCompany($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setAffiliation($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setType($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setLocation($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setSuite($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setlastLogin($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setlastUpdated($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setaccountCreation($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setComment($arr[$keys[22]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(cTableUsersPeer::DATABASE_NAME);

		if ($this->isColumnModified(cTableUsersPeer::ID)) $criteria->add(cTableUsersPeer::ID, $this->id);
		if ($this->isColumnModified(cTableUsersPeer::USER_NAME)) $criteria->add(cTableUsersPeer::USER_NAME, $this->user_name);
		if ($this->isColumnModified(cTableUsersPeer::PASSWORD)) $criteria->add(cTableUsersPeer::PASSWORD, $this->password);
		if ($this->isColumnModified(cTableUsersPeer::FIRST_NAME)) $criteria->add(cTableUsersPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(cTableUsersPeer::MIDDLE_NAME)) $criteria->add(cTableUsersPeer::MIDDLE_NAME, $this->middle_name);
		if ($this->isColumnModified(cTableUsersPeer::LAST_NAME)) $criteria->add(cTableUsersPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(cTableUsersPeer::PERSONAL_TITLE)) $criteria->add(cTableUsersPeer::PERSONAL_TITLE, $this->personal_title);
		if ($this->isColumnModified(cTableUsersPeer::PROFESSIONAL_TITLE)) $criteria->add(cTableUsersPeer::PROFESSIONAL_TITLE, $this->professional_title);
		if ($this->isColumnModified(cTableUsersPeer::PHONE_NUM_1)) $criteria->add(cTableUsersPeer::PHONE_NUM_1, $this->phone_num_1);
		if ($this->isColumnModified(cTableUsersPeer::PHONE_NUM_2)) $criteria->add(cTableUsersPeer::PHONE_NUM_2, $this->phone_num_2);
		if ($this->isColumnModified(cTableUsersPeer::EMAIL1)) $criteria->add(cTableUsersPeer::EMAIL1, $this->email1);
		if ($this->isColumnModified(cTableUsersPeer::EMAIL2)) $criteria->add(cTableUsersPeer::EMAIL2, $this->email2);
		if ($this->isColumnModified(cTableUsersPeer::ASSIGNED_ORG)) $criteria->add(cTableUsersPeer::ASSIGNED_ORG, $this->assigned_org);
		if ($this->isColumnModified(cTableUsersPeer::ORG)) $criteria->add(cTableUsersPeer::ORG, $this->org);
		if ($this->isColumnModified(cTableUsersPeer::COMPANY)) $criteria->add(cTableUsersPeer::COMPANY, $this->company);
		if ($this->isColumnModified(cTableUsersPeer::AFFILIATION)) $criteria->add(cTableUsersPeer::AFFILIATION, $this->affiliation);
		if ($this->isColumnModified(cTableUsersPeer::TYPE)) $criteria->add(cTableUsersPeer::TYPE, $this->type);
		if ($this->isColumnModified(cTableUsersPeer::LOCATION)) $criteria->add(cTableUsersPeer::LOCATION, $this->location);
		if ($this->isColumnModified(cTableUsersPeer::SUITE)) $criteria->add(cTableUsersPeer::SUITE, $this->suite);
		if ($this->isColumnModified(cTableUsersPeer::LAST_LOGIN)) $criteria->add(cTableUsersPeer::LAST_LOGIN, $this->last_login);
		if ($this->isColumnModified(cTableUsersPeer::LAST_UPDATED)) $criteria->add(cTableUsersPeer::LAST_UPDATED, $this->last_updated);
		if ($this->isColumnModified(cTableUsersPeer::ACCOUNT_CREATION)) $criteria->add(cTableUsersPeer::ACCOUNT_CREATION, $this->account_creation);
		if ($this->isColumnModified(cTableUsersPeer::COMMENT)) $criteria->add(cTableUsersPeer::COMMENT, $this->comment);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(cTableUsersPeer::DATABASE_NAME);
		$criteria->add(cTableUsersPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of cTableUsers (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setuserName($this->getuserName());
		$copyObj->setPassword($this->getPassword());
		$copyObj->setfirstName($this->getfirstName());
		$copyObj->setmiddleName($this->getmiddleName());
		$copyObj->setlastName($this->getlastName());
		$copyObj->setpersonalTitle($this->getpersonalTitle());
		$copyObj->setprofessionalTitle($this->getprofessionalTitle());
		$copyObj->setphoneNum1($this->getphoneNum1());
		$copyObj->setphoneNum2($this->getphoneNum2());
		$copyObj->setEmail1($this->getEmail1());
		$copyObj->setEmail2($this->getEmail2());
		$copyObj->setassignedOrg($this->getassignedOrg());
		$copyObj->setOrg($this->getOrg());
		$copyObj->setCompany($this->getCompany());
		$copyObj->setAffiliation($this->getAffiliation());
		$copyObj->setType($this->getType());
		$copyObj->setLocation($this->getLocation());
		$copyObj->setSuite($this->getSuite());
		$copyObj->setlastLogin($this->getlastLogin());
		$copyObj->setlastUpdated($this->getlastUpdated());
		$copyObj->setaccountCreation($this->getaccountCreation());
		$copyObj->setComment($this->getComment());
		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     cTableUsers Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     cTableUsersPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new cTableUsersPeer();
		}
		return self::$peer;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->user_name = null;
		$this->password = null;
		$this->first_name = null;
		$this->middle_name = null;
		$this->last_name = null;
		$this->personal_title = null;
		$this->professional_title = null;
		$this->phone_num_1 = null;
		$this->phone_num_2 = null;
		$this->email1 = null;
		$this->email2 = null;
		$this->assigned_org = null;
		$this->org = null;
		$this->company = null;
		$this->affiliation = null;
		$this->type = null;
		$this->location = null;
		$this->suite = null;
		$this->last_login = null;
		$this->last_updated = null;
		$this->account_creation = null;
		$this->comment = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(cTableUsersPeer::DEFAULT_STRING_FORMAT);
	}

} // BasecTableUsers
