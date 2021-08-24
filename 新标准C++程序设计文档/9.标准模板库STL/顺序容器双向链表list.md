# 双向链表list

* 双向链表的每个元素都有一个指针指向后一个元素，也有一个指针指向前一个元素
* 在任何位置插入删除都是常数时间
* 不支持随机存取, 也就是迭代器只能只能++, 不能一次性跳转
* 除了具有所有顺序容器都有的成员函数以外，还支持8个成员函数：
  * push_front: 在前面插入
  * pop_front: 删除前面的元素
  * sort: 排序 ( list 不支持 STL 的算法 sort)
  * remove: 删除和指定值相等的所有元素
  * unique: 删除所有和前一个元素相同的元素(要做到元素不重复，则unique之前还需要 sort)
  * merge: 合并两个链表，并清空被合并的那个
  * reverse: 颠倒链表
  * splice: 在指定位置前面插入另一链表中的一个或多个元素,并在另一链表中删除被插入的元素

```c++
#include <iostream>
#include<list>
#include <algorithm>

using namespace std;

template <class T>
void Print(T first, T last) {
    for (; first!=last; ++first) {
        cout << *first << " ";
    }
    cout << endl;
}

int main() {
    list<int> l = {3, 5, 2, 3, 1, 4};
    Print(l.begin(), l.end()); // 3 5 2 3 1 4

    l.push_front(6);
    l.push_back(7);
    Print(l.begin(), l.end()); // 6 3 5 2 3 1 4 7

    l.sort(); // 1 2 3 3 4 5 6 7
    Print(l.begin(), l.end());

    l.reverse();
    Print(l.begin(), l.end()); // 7 6 5 4 3 3 2 1

    l.push_front(3);
    l.remove(3);
    Print(l.begin(), l.end()); // 7 6 5 4 2 1

    list<int> l2 = {10, 40, 30, 30, 50, 30};
    Print(l2.begin(), l2.end()); // 10 40 30 30 50 30

    l2.unique();
    Print(l2.begin(), l2.end()); // 10 40 30 50 30  // 注意,　后面的30是没有删除的

    l.merge(l2);
    Print(l.begin(), l.end()); // 7 6 5 4 2 1 10 40 30 50 30
    cout << l2.size() << endl; // 0 // l2已经清空

    list<int> l3 = {22, 11, 33, 55, 44};

    list<int>::iterator p1, p2, p3;
    p1 = find(l.begin(), l.end(), 5);
    p2 = find(l3.begin(), l3.end(), 11);
    p3 = find(l3.begin(), l3.end(), 55);
    l.splice(p1,l3, p2, p3); // 将l3中[p2, p3)插在l中p1后, 并从将l3中删除[p2, p3)
    Print(l.begin(), l.end()); // 7 6 11 33 5 4 2 1 10 40 30 50 30
    Print(l3.begin(), l3.end()); // 22 55 44
    
    return 0;
}
```

