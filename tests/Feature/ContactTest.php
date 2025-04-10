<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Exception;
use Mockery;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_a_contact_successfully()
    {
        // Create a user
        $user = User::factory()->create();
        
        // Create a contact
        $contact = Contact::factory()->create([
            'user_id' => $user->id
        ]);
        
        // Send delete request
        $response = $this->delete(route('contacts.destroy', $contact));
        
        // Assert redirect with success message
        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('success', 'Contact deleted successfully.');
        
        // Assert the contact is deleted from the database
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }
    
    /** @test */
    public function it_shows_error_on_simulated_error()
    {
        // Create a user
        $user = User::factory()->create();
        
        // Create a contact
        $contact = Contact::factory()->create([
            'user_id' => $user->id
        ]);
        
        // Send delete request with simulate_error parameter
        $response = $this->delete(route('contacts.destroy', $contact), [
            'simulate_error' => '1'
        ]);
        
        // Assert redirect with error message
        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('error', 'Could not delete contact (simulated server error)');
        
        // Assert the contact still exists in the database
        $this->assertDatabaseHas('contacts', ['id' => $contact->id]);
    }
    
    /** @test */
    public function it_handles_deletion_exception_properly()
    {
        // Create a user
        $user = User::factory()->create();
        
        // Create a contact
        $contact = Contact::factory()->create([
            'user_id' => $user->id
        ]);
        
        // Mock the Contact model to throw an exception when delete is called
        $mockContact = Mockery::mock($contact);
        $mockContact->shouldReceive('delete')->once()->andThrow(new Exception('Database constraint violation'));
        
        // Replace the route model binding with our mock
        $this->app->instance(Contact::class, $mockContact);
        
        // Send delete request
        $response = $this->delete(route('contacts.destroy', $contact));
        
        // Assert redirect with error message
        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('error', 'This contact could not be deleted. It may be referenced by other records.');
    }
}