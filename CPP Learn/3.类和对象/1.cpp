/*
	设计一个名为Rectangle的矩形类，其属性为矩形的左上角和右下角两个点
	的坐标，能计算和输出矩形的周长与面积。
*/
#include<iostream>
using namespace std;
typedef struct ZuoBiao {
	int x;//x,y轴
	int y;
} ZuoBiao; //坐标

class Rectangle {
	public:
		ZuoBiao left;//左上顶点
		ZuoBiao right;//右下顶点

		int ZhouChang(ZuoBiao left, ZuoBiao right); //周长
		int MianJi(ZuoBiao left, ZuoBiao right); //面积
		Rectangle(ZuoBiao a, ZuoBiao b) {
			left = a;
			right = b;
		}
};
int Rectangle::ZhouChang(ZuoBiao left, ZuoBiao right) {
	int L, H; //长和宽
	L = right.x - left.x;
	H = left.y - right.y;
	return (L * 2) + (H * 2);
}
int Rectangle::MianJi(ZuoBiao left, ZuoBiao right) {
	int L, H; //长和宽
	L = right.x - left.x;
	H = left.y - right.y;
	return (L * H);
}
int main() {
	ZuoBiao a, b;
	a.x = 3;
	a.y = 10;
	b.x = 12; //12-3=9,10-4=6. (6+9)*2=30,6*9=54;
	b.y = 4;

	Rectangle object(a, b);
	cout << "周长为：\t" << object.ZhouChang(a, b) << endl;
	cout << "面积为：\t" << object.MianJi(a, b) << endl;
	return 0;
}
