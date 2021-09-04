/*
	设计一个矩形类rect,类数据成员有右上角的坐标值x,y，宽w,高h,要求有下述
	成员函数。
	1.move():从一个位置移动到另一个位置.
	2.size():改变矩形的大小
	3.where():返回矩形右下角的坐标值
	4.area():计算矩形的面积.
*/
#include<iostream>
using namespace std;

typedef struct Zuobiao
{
	int x;//x轴
	int y;//y轴
}Zuobiao;
Zuobiao CHUSHI;//初始值
class rect
{
	Zuobiao k;
	int w;//宽
	int h;//高
public:
	rect();
	void move(int a,int b);//	从一个位置移动到另一个位置.
	void size();//	改变矩形的大小
	Zuobiao where();//	返回矩形左下角的坐标值
	int area();//	计算矩形的面积.	
	
};
rect::rect()
{
	k.x=1;k.y=1;w=0;h=0;
	CHUSHI.x=1;
	CHUSHI.y=1;
	
}
void rect::move(int a,int b)//之后的坐标
{
	w=a-(k.x);
	h=b-(k.y);
	k.x=a;k.y=b;//(0,0)->(1,1)
}

void rect::size()
{	int control;
	float Mianji;
	cout<<"请输入矩形的面积大小"<<endl;
	cin>>Mianji;
	cout<<"请选择保持宽不变(1)还是高不变(0)？"<<endl;
	cin>>control;
	if(control)
	{	
			h=Mianji/w;
			k.y=h;
	}	
	else
	{
		w=Mianji/h;
		k.x=w;
	}
		
}

Zuobiao rect::where()
{
	Zuobiao p;
	p.x=k.x-CHUSHI.x;
	p.y=k.y-CHUSHI.y;
	return p;
}
int rect::area()
{
	int z;
	z=w*h;
	return z;
}
int main()
{
	rect object;
	Zuobiao p;
	object.move(3,3);
	cout<<"面积为：\t"<<object.area()<<endl;
	object.size();
	p=object.where();
	cout<<"左下角的坐标值：\t"<<p.x<<"\t"<<p.y<<endl;
	return 0;
}
