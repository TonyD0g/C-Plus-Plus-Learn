#include<stdio.h>
#include<math.h>
int main()
{
	int x,y;
	scanf("%d %d",&x,&y);
		
	if(x%400==0||x%4==0&&x%100!=0)
	{
		if(y>12||y<1)
		{
			printf("Leap year,");
			printf("Fall,");
		printf("30\n");
		}
		else
				if(y>=3&&y<=5)
					{
						printf("Leap year,");
						printf("Spring,");
						switch(y)
						{
						case 4:printf("30\n");break;
						case 3:case 5:printf("31\n");break;
						}
					
					}

					else 
						if(y>=6&&y<=8)
					{	
						printf("Leap year,");
						printf("Summer,");
						switch(y)
						{
						case 6:printf("30\n");break;
						case 7:case 8:printf("31\n");break;
						}
				
			
			
					}
						else 
							if(x>=9&&x<=11)
				{
					printf("Leap year,");
					printf("Autumn,");
					switch(y)
					{
						case 10:printf("31\n");break;
						case 9:case 11:printf("30\n");break;
					}
				
				
				}
							else
							
								{	printf("Leap year,");
									printf("Winter,");
									switch(y)
									{
										case 2:printf("29\n");break;
										case 12:case 1:printf("31\n");break;
										default:printf("Fall");
									}
				
								}
							
					
	
	}//实验
				else 
					{
		printf("Common year,");
		//实验
		if(y>=3&&y<=5)
		{
			printf("Spring,");
			switch(y)
		{
			case 4:printf("30\n");break;
			case 3:case 5:printf("31\n");break;
		}
	}
		else 
			if(y>=6&&y<=8)
			{
				printf("Summer,");
				switch(y)
				{
				case 6:printf("30\n");break;
				case 7:case 8:printf("31\n");break;
				}
			
			}
			else 
				if(x>=9&&x<=11)
				{
					printf("Autumn,");
					switch(y)
					{
						case 10:printf("31\n");break;
						case 9:case 11:printf("30\n");break;
					}
				}
				else
				{
					printf("Winter,");
					switch(y)
					{
					case 2:printf("28\n");break;
					case 12:case 1:printf("31\n");break;
					}
				
				}

	}
							return 0;
							







}






