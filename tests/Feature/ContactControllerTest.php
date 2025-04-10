<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Authenticate a user to avoid errors in Blade components (like in sidebar)
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /**
     * Test the index method returns the contacts index view with paginated contacts.
     */
    public function testIndexDisplaysContacts()
    {
        // Arrange: Create a few contacts
        Contact::factory()->count(15)->create();

        // Act
        $response = $this->get(route('contacts.index'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.index');
        $response->assertViewHas('contacts');
        // Optionally, confirm pagination works
        $contacts = $response->viewData('contacts');
        $this->assertEquals(10, $contacts->count());
    }

    /**
     * Test that the create method displays the creation form along with a list of users.
     */
    public function testCreateDisplaysFormWithUsers()
    {
        // Arrange: Create some users to be available in the select
        User::factory()->count(5)->create();

        // Act
        $response = $this->get(route('contacts.create'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.create');
        $response->assertViewHas('users');
    }

    /**
     * Test storing a valid contact.
     */
    public function testStoreCreatesContactAndRedirects()
    {
        // Arrange: Create a user for the contact
        $user = User::factory()->create();

        $data = [
            'user_id'     => $user->id,
            'mobile'      => '1234567890',
            'address'     => '123 Test St',
            'postal_code' => '12345',
            'city'        => 'Testville',
            'country'     => 'Testland',
            'notes'       => 'A new test contact',
        ];

        // Act
        $response = $this->post(route('contacts.store'), $data);

        // Assert: Database has been updated
        $this->assertDatabaseHas('contacts', [
            'user_id' => $user->id,
            'mobile'  => '1234567890',
        ]);

        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('success', 'Contact created successfully.');
    }

    /**
     * Test storing a contact with simulated error.
     */
    public function testStoreSimulatedErrorReturnsBackWithError()
    {
        // Arrange
        $user = User::factory()->create();
        $data = [
            'user_id'        => $user->id,
            'mobile'         => '1234567890',
            'simulate_error' => true,
        ];

        // Act
        $response = $this->post(route('contacts.store'), $data);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Could not create contact (simulated server error)');
        // Expecting at least one field to be in old input, e.g., "mobile"
        $response->assertSessionHasInput(['mobile']);
    }

    /**
     * Test that the show method displays a single contact.
     */
    public function testShowDisplaysContact()
    {
        // Arrange
        $contact = Contact::factory()->create();

        // Act
        $response = $this->get(route('contacts.show', $contact));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.show');
        $response->assertViewHas('contact', function ($viewContact) use ($contact) {
            return $viewContact->id === $contact->id;
        });
    }

    /**
     * Test that the edit method returns the correct view with users.
     */
    public function testEditDisplaysFormWithContactAndUsers()
    {
        // Arrange
        $contact = Contact::factory()->create();
        User::factory()->count(3)->create();

        // Act
        $response = $this->get(route('contacts.edit', $contact));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('contacts.edit');
        $response->assertViewHasAll(['contact', 'users']);
    }

    /**
     * Test updating a contact successfully.
     */
    public function testUpdateModifiesContactAndRedirects()
    {
        // Arrange
        $contact = Contact::factory()->create([
            'mobile' => '1111111111'
        ]);
        $newUser = User::factory()->create();

        $data = [
            'user_id'     => $newUser->id,
            'mobile'      => '2222222222',
            'address'     => '456 Changed Ave',
            'postal_code' => '54321',
            'city'        => 'Change City',
            'country'     => 'Change Land',
            'notes'       => 'Updated contact note',
        ];

        // Act
        $response = $this->put(route('contacts.update', $contact), $data);

        // Assert: Check that the record was updated
        $this->assertDatabaseHas('contacts', [
            'id'      => $contact->id,
            'user_id' => $newUser->id,
            'mobile'  => '2222222222',
        ]);

        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('success', 'Contact updated successfully.');
    }

    /**
     * Test updating a contact with simulated error.
     */
    public function testUpdateSimulatedErrorReturnsBackWithError()
    {
        // Arrange
        $contact = Contact::factory()->create();
        $data = [
            'simulate_error' => true,
            // Minimal valid data to pass validation (simulate_error is checked before validation)
            'user_id' => $contact->user_id,
            'mobile'  => '3333333333'
        ];

        // Act
        $response = $this->put(route('contacts.update', $contact), $data);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHas('error', 'Could not update contact (simulated server error)');
        // Provide expected keys for session input; adjust as necessary.
        $response->assertSessionHasInput(['mobile']);
    }

    /**
     * Test deleting a contact successfully.
     */
    public function testDestroyDeletesContactAndRedirects()
    {
        // Arrange
        $contact = Contact::factory()->create();

        // Act
        $response = $this->delete(route('contacts.destroy', $contact));

        // Assert: The contact should be removed from the database
        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
        ]);
        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('success', 'Contact deleted successfully.');
    }

    /**
     * Test simulated error during contact deletion.
     */
    public function testDestroySimulatedErrorRedirectsWithError()
    {
        // Arrange
        $contact = Contact::factory()->create();

        // Act: Append simulate_error to the query string
        $response = $this->delete(route('contacts.destroy', $contact) . '?simulate_error=1');

        // Assert: The contact should still exist
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
        ]);
        $response->assertRedirect(route('contacts.index'));
        $response->assertSessionHas('error', 'Could not delete contact (simulated server error)');
    }
}
