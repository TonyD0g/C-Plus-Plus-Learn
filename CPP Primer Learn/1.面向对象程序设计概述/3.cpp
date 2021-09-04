
/*
		编写程序将成绩分数的百分制转换成等级制，即A,B,C,D,E
		A(>=90)
		B(<90&&>=80)
		依次类推
*/

#include<iostream>
using	namespace std;
int main() {
	int score;
	cout << "Please input Your score" << endl;
	cin >> score;
	if (score > 100) {
		cout << "The score is not exit!\n" << endl;
		exit(0);
	}
	if (score >= 90)
		cout << "A" << endl;
	if (score < 90 && score >= 80)
		cout << "B" << endl;
	if (score < 80 && score >= 70)
		cout << "C" << endl;
	if (score < 70 && score >= 60)
		cout << "D" << endl;
	if (score < 60)
		cout << "E" << endl;

	return 0;
}
