guard 'phpunit', :tests_path => 'tests', :cli => '--colors' do
  watch(%r{^.+Test\.php$})
  watch('src/Acne.php') {|m| 'tests/AcneTest.php' }
end
