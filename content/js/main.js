$(function()
{

	$('.ufo > div').hover(
		function()
		{
			$(this).find('.info').fadeIn('fast');
		},
		function()
		{
			$(this).find('.info').hide();
		}
	);
	
});