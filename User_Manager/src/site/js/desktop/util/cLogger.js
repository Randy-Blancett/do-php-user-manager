Ext.define('darkowl.desktop.util.cLogger',
{
	singleton : true,
	alternateClassName :
	[
		'desktop.logger'
	],
	statics :
	{
		C_INT_LEVEL_ERROR : 100,
		C_INT_LEVEL_LOW : 200,
		C_INT_LEVEL_INFO : 300,
		C_INT_LEVEL_MEDIUM : 400,
		C_INT_LEVEL_HIGH : 500,
		C_INT_LEVEL_DETAILED : 600
	}

	,
	log : function (str_Message, int_Level)
	{
		if (console)
		{
			if (!int_Level)
			{
				int_Level = 200;
			}
			console.log(str_Message);
		}
	}
});