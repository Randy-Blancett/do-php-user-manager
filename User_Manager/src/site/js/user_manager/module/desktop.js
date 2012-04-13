Ext.define('darkowl.userManager.module.desktop',
{
	extend : 'darkowl.desktop.module.abs_Module',
	// singleton : true,
	m_str_Name : "User Manager Desktop",
	requires :
	[
		'Ext.data.Store'
	],
	constructor : function (config)
	{
		this.m_obj_Shortcuts = Ext.create('Ext.data.Store',
		{
			fields :
			[
					'name', 'iconCls'
			],
			data :
			{
				'items' :
				[
					{
						'name' : 'Test 123',
						"iconCls" : "menu-action-view-icon"
					}
				]
			},
			proxy :
			{
				type : 'memory',
				reader :
				{
					type : 'json',
					root : 'items'
				}
			}
		});
	}
});