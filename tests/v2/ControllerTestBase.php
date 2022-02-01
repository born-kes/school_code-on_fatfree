<?php
declare(strict_types = 1);
namespace tests\v2;

use PHPUnit\Framework\TestCase;

class ControllerTestBase extends TestCase
{
    const Not_implement_controller_interface = 'Not implement controller interface';

    /** auxiliary
     * @param interface $interface
     * @param string $method
     * @param mixed $return
     * @return stdClass
     */
    protected function _buildMock($interface, string $method, $return = null)
    {
        $mock = $this->createMock($interface);
        return $this->_build(
            $mock,
            $method,
            $return
        );
    }

    /** auxiliary
     * @param object $stub
     * @param string $method
     * @param mixed $return
     * @return object
     */
    protected function _build($stub, string $method, $return = null)
    {
        if (is_null($return)) {
            $stub->method($method);
        } else if (!is_array($return)) {
            $stub->method($method)->willReturn($return);
        } else {
            $stub->method($method)->willReturn($this->onConsecutiveCalls($return));
        }
        return $stub;
    }

    /** auxiliary
     * @param interface $interface
     * @param string $method
     * @param mixed $return
     * @return object
     */
    protected function _buildStub($interface, $method, $return = null)
    {
        $stub = $this->createStub($interface);
        return $this->_build(
            $stub,
            $method,
            $return
        );
    }
/**


    public function sortId(): string {}

    public function provides(): array {}

    public function requires(): array {}

    public function count() {}

    public function toString(): string {}

    public function run(TestResult $result = null): TestResult {}
    //**/

}