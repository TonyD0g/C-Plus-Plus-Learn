# bitset模板类定义

```c++
template<size_t N>
class bitset {
	…
};
```

* 实际使用的时候，N是个整型常数
* 如bitset<40> bst;　bst是一个由40位组成的对象，用bitset的函数可以方便地访问任何一位

```c++
#include <iostream>
#include<bitset>

using namespace std;

int main() {
    bitset<40> bst;
    cout << bst.size() << endl;  // Returns the total number of bits

    bst.set(); // Sets every bit to true
    cout << bst << endl; // 输出：1111111111111111111111111111111111111111
    cout << bst.all() << endl; // 输出：　1  // True if all the bits are set

    bst.reset(); // Sets every bit to false
    cout << bst << endl; // 输出：0000000000000000000000000000000000000000

    bst.set(0, true); // 将第0位置1
    bst.set(8); // 将第8位置1
    cout << bst << endl; // 输出：　0000000000000000000000000000000100000001
    bst.set(8, false);  // 将第8位清0
    cout << bst << endl; // 0000000000000000000000000000000000000001

    bst.flip(); // Toggles every bit to its opposite value
    cout << bst << endl; // 1111111111111111111111111111111111111110
    bst.flip(0); // Toggles a given bit to its opposite value
    cout << bst << endl; // 1111111111111111111111111111111111111111

    cout << bst[3] << endl; // 1
    bst[3] = false;
    cout << bst << endl; // 1111111111111111111111111111111111110111

    cout << bst.to_string() << endl; // Returns a character interpretation of the %bitset
    cout << bst.to_ulong() << endl; // The integral equivalent of the bits

    return 0;
}
```

