Ext.define('darkowl.userManager.config.cDialog',
	{
		singleton: true,
		alternateClassName:
			[
				'userManager.dialog'
			],
		statics:
			{
				C_STR_ACTION_SAVE_WAIT: "Saveing Data...",
				C_STR_ACTION_SAVE_SUCCESS: "Action Successfuly Saved.",
				C_STR_ACTION_DELETE_SUCCESS: "Action Successfuly Deleted.",
				C_STR_APPLICATION_SAVE_WAIT: "Saveing Data...",
				C_STR_APPLICATION_SAVE_SUCCESS: "Application Successfuly Saved.",
				C_STR_APPLICATION_DELETE_SUCCESS: "Application Successfuly Deleted.",
				C_STR_APPLICATION_DELETE_CONFIRM: "Application Successfuly Deleted.",
				C_STR_GROUP_SAVE_WAIT: "Saveing Data...",
				C_STR_GROUP_SAVE_SUCCESS: "Group Successfuly Saved.",
				C_STR_GROUP_DELETE_SUCCESS: "Group Successfuly Deleted.",
				C_STR_GROUP_DELETE_CONFIRM: "Group Successfuly Deleted.",
				C_STR_USER_SAVE_WAIT: "Saveing Data...",
				C_STR_USER_SAVE_SUCCESS: "User Successfuly Saved.",
				C_STR_USER_DELETE_SUCCESS: "User Successfuly Deleted.",
				C_STR_ERROR_SELECT_ONE: "You must select an Item.",
				C_STR_ERROR_SELECT_ONLY_ONE: "You must select only one Item.",
				C_STR_DIALOG_SUCCESS_TITLE: "Success",
				C_STR_DIALOG_CONFIRM_TITLE: "Please Confirm",
				C_STR_DIALOG_CONFIRM_DIALOG: "Are you sure you want to delete ",
				C_STR_DIALOG_GENERIC_SAVE_WAIT: "Saving Data..."
			}
	});