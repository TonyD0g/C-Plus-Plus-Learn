#include<stdio.h>
void menu(int p);
void stu_infor_into(struct stu stu1[],int n,int *c,int *e,int *z,int *trol);//*e:防止输入重复学号,*z：控制用户必须先使用功能1
void stu_infor_put(struct stu stu1[],int n,int *c,int *e,int *z);
void stu_change_put(struct stu stu1[],int n,int *c,int *e,int *z);
void stu_search(struct stu stu1[],int n,int *c,int *e,int *z);
void stu_aver(struct stu stu1[],int n,int *c,int *e,int *z);
void stu_delete(struct stu stu1[],int n,int *c,int *e,int *z);
void stu_add(struct stu stu1[],int n,int *c,int *e,int *z);
void stu_overaver(struct stu stu1[],int n,int *c,int *e,int *z);
void stu_list(struct stu stu1[],int n,int *c,int *e,int *z);
int search(struct stu stu1[],int n,int x);
int search1(struct stu stu1[],int n,int x);
int sum(struct stu stu1[],int n);
int aver(struct stu stu1[],int n);
struct stu
	{
		char name[10];
		int num;
		float chinese;
		float math;
		float english;
	};
struct stu stu1[50];
void main()//主函数
{
	int p=1;
	menu(p);

}

void menu(int p)//菜单功能

{
	int x,y=0,n,c=0,q=0,qz=0,control=0;//n：输入的学生个数，c：控制输出的学生个数，q:防止输入重复学号,qz：控制用户必须先使用功能1.control:控制用户只能使用一次功能1.
	printf("\t正在进入教务系统，请稍后。。。\n警告：只能录入50个学生！，超出部分无法录入！\n请输入要录入教务系统的学生个数\n————————————\n");
	scanf("%d",&n);
	printf("————————————\n");
	while(p)
	{
		printf("输入1，学生基本信息录入\n输入2，学生基本信息的输出\n输入3，按学号查询学生信息\n输入4，按学号修改某学生信息并输出\n输入5，求每个人平均成绩\n输入6，删除某学生信息\n输入7，添加某学生信息\n输入8，输出平均分大于80分的同学信息\n输入9，根据总成绩或平均成绩综合排名\n————————————\n请输入功能对应的数字\n\n————————————\n");
		scanf("%d",&x);
		printf("————————————\n");
		switch(x)
		{
		default:printf("此功能不存在！，请重新输入\n————————————\n");break;
		case 1:if(control==0)stu_infor_into(stu1,n,&c,&q,&qz,&control);else printf("该功能只能进入一次！\n");break;
		case 2:stu_infor_put(stu1,n,&c,&q,&qz);break;
		case 3:stu_search(stu1,n,&c,&q,&qz);break;
		case 4:stu_change_put(stu1,n,&c,&q,&qz);break;
		case 5:stu_aver(stu1,n,&c,&q,&qz);break;
		case 6:stu_delete(stu1,n,&c,&q,&qz);break;
		case 7:stu_add(stu1,n,&c,&q,&qz);break;
		case 8:stu_overaver(stu1,n,&c,&q,&qz);break;
		case 9:stu_list(stu1,n,&c,&q,&qz);break;
		}
	}
}

void stu_infor_into(struct stu stu1[],int n,int *c,int *e,int *z,int *trol)//1.学生基本信息录入模块
{
	int i,j,a[50];
	printf("请按以下输入格式进行输入！！！\n案例:\n学号\t姓名\t语文\t数学\t英语\n1 XiaoMin 100 100 100\n现在开始输入：\n");
	*e=0;
	for(i=0;i<n;i++)
	{
		scanf("%d %s %f %f %f",&stu1[i].num,stu1[i].name,&stu1[i].chinese,&stu1[i].math,&stu1[i].english);
		for(j=0;j<n;j++)
		{
			if(a[j]==stu1[i].num)
			{	printf("你已重复输入某一学号了！，请重新进入本模块！\n");
				break;
			}
		}
		if(a[j]==stu1[i].num)
		{	*e=*e+1;//防止重复学号
			break;
		}
		a[i]=stu1[i].num;
		if(*c>=1)//控制输出的学生个数
		{	*c=*c-1;}
	}
	printf("输入操作完成！\n————————————\n");
	*z=*z+1;
	if(*e!=1)
	*trol=*trol+1;
}

void stu_infor_put(struct stu stu1[],int n,int *c,int *e,int *z)//2.学生基本信息输出
{
	int i,x;
	if(*z>=1)
	{
		if(*e==1)
	{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
	else
	{
	
		printf("学号\t姓名\t语文\t数学\t英语\n");
		for(i=0;i<n-*c;i++)
		{
		printf("%d\t",stu1[i].num);
		printf("%s\t",stu1[i].name);
		printf("%.2f\t",stu1[i].chinese);
		printf("%.2f\t",stu1[i].math);
		printf("%.2f\n",stu1[i].english);
		}
		printf("————————————\n");
	}
	}
}

void stu_search(struct stu stu1[],int n,int *c,int *e,int *z)//3.按学号查询学生信息
{
	int i,y,x;
	if(*z>=1)
	{
			if(*e==1)
			{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
		else
		{
				printf("请输入你要查询的学生学号\n");
				scanf("%d",&x);
				printf("\n————————————\n");
				y=search(stu1,n-*c,x);
			if(y==0)
			{
				printf("该学生不存在！\n————————————\n");
			}
			else
			{
				for(i=0;i<n-*c;i++)
				{
				if(stu1[i].num==y)
				printf("此学生信息如下：\n学号\t姓名\t语文\t数学\t英语\n%d\t%s\t%.2f\t%.2f\t%.2f\t",stu1[i].num,stu1[i].name,stu1[i].chinese,stu1[i].math,stu1[i].english);
				}
			}
		}
				printf("\n————————————\n");
	}
}


void stu_change_put(struct stu stu1[],int n,int *c,int *e,int *z)//4.按学号修改学生信息并输出
{

	int i,j,p=1,x;
		if(*z>=1)
	{
	if(*e==1)
	{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
	else
	{
	printf("请输入该学生学号\n");
	scanf("%d",&x);
	printf("————————————\n请输入你要修改的学生内容:\n");
	printf("输入1：修改学生姓名\n输入2:修改语文成绩\n输入3：修改数学成绩\n输入4：修改英语成绩\n");
	scanf("%d",&j);
	printf("正在进入第%d个功能...\n————————————\n",j);
	switch(j)
	{
		case 1:i=search1(stu1,n-*c,x);printf("请输入修改内容\n");scanf("%s",stu1[i].name);printf("修改完成\n————————————\n");break;
		case 2:i=search1(stu1,n-*c,x);printf("请输入修改内容\n");scanf("%f",&stu1[i].chinese);printf("修改完成\n————————————\n");break;
		case 3:i=search1(stu1,n-*c,x);printf("请输入修改内容\n");scanf("%f",&stu1[i].math);printf("修改完成\n————————————\n");break;
		case 4:i=search1(stu1,n-*c,x);printf("请输入修改内容\n");scanf("%f",&stu1[i].english);printf("修改完成\n————————————\n");break;
		default:printf("不存在此功能！请重新进入此模块!————————————\n");break;
	}
	}
	}
}

void stu_aver(struct stu stu1[],int n,int *c,int *e,int *z)//5.求每个人的平均成绩
{
	int i;float s;//stu_aver(stu1,n)
	if(*z>=1)
	{
	if(*e==1)
	{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
	else
	{
	printf("学生\t平均成绩\n");
	for(i=0;i<n-*c;i++)
	{
		s=aver(stu1,i);
		printf("%s\t",stu1[i].name);
		printf("%.2f\n",s);
	}
	printf("\n————————————\n");
	}
	}
}

void stu_delete(struct stu stu1[],int n,int *c,int *e,int *z)//6.删除某学生信息
{
	int i,x,j,y,p=0;
	if(*z>=1)
	{
	if(*e==1)
	{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
	else
	{
	printf("请输入你要删除的学生学号\n");
	scanf("%d",&x);
	y=search(stu1,n-*c,x);
	if(y==0)
	{
		printf("没有该学号！请重新进入本模块！\n————————————\n");
	}
	else
	{
		for(i=0;i<n-*c;i++)
		{
			while(stu1[i].num==x)
			{		p=p+1;
			for(j=i;j<n-*c;j++)
			{
			
				stu1[j].num=stu1[j+1].num;
				strcpy(stu1[j].name,stu1[j+1].name);
				stu1[j].chinese=stu1[j+1].chinese;
				stu1[j].math=stu1[j+1].math;
				stu1[j].english=stu1[j+1].english;
			}
			}
			
		}
		for(j=0;j<p;j++)
				*c=*c+1;
			printf("————————————\n该学号的学生信息删除完成\n\n————————————\n");
	}
	}
	}
}
void stu_add(struct stu stu1[],int n,int *c,int *e,int *z)//7.添加某学生信息
{
	
	int i,x,j,p=0,a[50];
	if(*z>=1)
	{
	if(*e==1)
	{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
	else
	{
	printf("请输入你要添加的学生个数\n");
	scanf("%d",&x);
	printf("请按以下输入格式进行输入！！！\n案例:\n学号\t姓名\t语文\t数学\t英语\n1 XiaoMin 100 100 100\n现在开始输入：\n————————————\n");
	for(i=0;i<n-*c;i++)
	{
		a[i]=stu1[i].num;
	}
	for(i=n-*c;i<n-*c+x;i++)
	{
		p=p+1;
		scanf("%d %s %f %f %f",&stu1[i].num,stu1[i].name,&stu1[i].chinese,&stu1[i].math,&stu1[i].english);
		for(j=0;j<n;j++)
		{
			if(a[j]==stu1[i].num)
			{	printf("你已重复输入某一学号了！，请重新进入本模块！\n");
			
				break;
			}
		}
		if(a[j]==stu1[i].num)
		{	*e=*e+1;//防止重复学号
			break;
		}
		a[i]=stu1[i].num;
	}
	*e=*e-1;
	printf("————————————\n");
	if(a[j]!=stu1[i].num)
	for(i=0;i<p;i++)
		*c=*c-1;
	}
	}
}

void stu_overaver(struct stu stu1[],int n,int *c,int *e,int *z)//8.输出平均分大于80分的同学信息
{
	int i,s;
	if(*z>=1)
	{
	if(*e==1)
	{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
	else
	{
	printf("平均分大于80分的同学信息：\n学号\t姓名\t语文\t数学\t英语\n");
	for(i=0;i<n-*c;i++)
	{
		s=aver(stu1,i);
		if(s>80)
		{
			printf("%d\t%s\t%.2f\t%.2f\t%.2f\t\n",stu1[i].num,stu1[i].name,stu1[i].chinese,stu1[i].math,stu1[i].english);
		}
	}
	printf("————————————\n");
	}
	}

}
void stu_list(struct stu stu1[],int n,int *c,int *e,int *z)//9.根据总成绩或平均成绩综合排名
{
	int i,t,j,a[50],m[50],b,s,x,d,g=0;//n：输入的学生个数，*c：控制输入学生个数，b:学生学号。s：平均分或总分。x：用户输入。d：用于检索。g：用于控制。
	if(*z>=1)
	{
	if(*e==1)
	{printf("请先使用功能1对数据库进行录入！\n————————————\n");}
	else
	{
	printf("你想根据总成绩还是平均成绩进行排名？\n输入1，将根据平均分排名。输入2，将根据总成绩排名\n");
	scanf("%d",&x);
	printf("————————————\n");
	if(x==1)
	{
		for(i=0;i<n-*c;i++)
	{
		a[i]=aver(stu1,i);
	}
	for(i=0;i<n-*c;i++)
	{
		for(j=i;j<n-*c;j++)
		{
			if(a[i]<a[j])
			{
				t=a[i];
				a[i]=a[j];
				a[j]=t;
			}
		}
	}
			printf("平均分从高到低排名顺序为:\n");
		for(i=0;i<n-*c;i++)
		{
			for(j=0;j<n-*c;j++)
			{
					g=0;
				s=aver(stu1,j);
				if(s==a[i])
				{
					b=search(stu1,n-*c,j);
					for(d=0;d<n-*c+1;d++)
					{
						if(m[d]==b)
						{
							g=g+1;
							break;//使得j=j+1;
						}
					}
					if(g==0)
					{
							m[i]=b;
					printf("%s\n",stu1[j].name);
					break;
					}
				}
				
			}
		
						
		}	
	}
	else
	{
		if(x==2)
	{
		for(i=0;i<n-*c;i++)
	{
		a[i]=sum(stu1,i);
	}
	for(i=0;i<n-*c;i++)
	{
		for(j=i;j<n-*c;j++)
		{
			if(a[i]<a[j])
			{
				t=a[i];
				a[i]=a[j];
				a[j]=t;
			}
		}
	}
	
			printf("\n————————————\n总分从高到底排名顺序为:\n");
			for(i=0;i<n-*c;i++)
		{
			for(j=0;j<n-*c;j++)
			{
					g=0;
				s=sum(stu1,j);
				if(s==a[i])
				{
					b=search(stu1,n-*c,j);
					for(d=0;d<n-*c;d++)
					{
						if(m[d]==b)
						{
							g=g+1;
							break;//使得j=j+1;
						}
					}
					if(g==0)
					{
							m[i]=b;
					printf("%s\n",stu1[j].name);
					break;
					}
				}
				
			}
		
						
		}
		}
	}
			printf("\n————————————\n");
	}
	}
}

int aver(struct stu stu1[],int n)//求平均分
{
	float aver;
	aver=(stu1[n].chinese+stu1[n].english+stu1[n].math)/3.0;
	return aver;
}
int search(struct stu stu1[],int n,int x)//查找函数
{
	int i;
	for(i=0;i<n;i++)
	{
		if(stu1[i].num==x)
		{
			return stu1[i].num;
		}
	}
	return 0;
}
int search1(struct stu stu1[],int n,int x)//search函数的增强
{
	int y,i;
	y=search(stu1,n,x);
	if(y==0)
	{
		printf("该学号不存在！现重新进入此功能！");
	}
	  else
	  {
			for(i=0;i<n;i++)
			{
				if(stu1[i].num==y)
				{
					return i;
				}
			}
	  }
}
int sum(struct stu stu1[],int n)//求总分
{
	float sum;
	sum=(stu1[n].chinese+stu1[n].math+stu1[n].english);
	return sum;
}